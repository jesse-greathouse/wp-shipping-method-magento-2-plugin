<?php


namespace Wheelpros\Checkout\Model;

use Exception;
use Wheelpros\Checkout\Api\EmailSubscriptionManagerInterface;

class EmailSubscriptionManager implements EmailSubscriptionManagerInterface
{
    /**
     * @var \Wheelpros\Checkout\Model\ResourceModel\CheckoutDummyData
     */
    private $checkoutDummyDataResource;

    /**
     * @var \Wheelpros\Checkout\Model\CheckoutDummyDataFactory
     */
    private $checkoutDummyDataFactory;

    /**
     * @var \Magento\Quote\Model\MaskedQuoteIdToQuoteIdInterface
     */
    private $maskedQuoteIdToQuoteId;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * EmailSubscriptionManager constructor.
     *
     * @param \Wheelpros\Checkout\Model\ResourceModel\CheckoutDummyData $checkoutDummyDataResource
     * @param \Wheelpros\Checkout\Model\CheckoutDummyDataFactory $checkoutDummyDataFactory
     * @param \Magento\Quote\Model\MaskedQuoteIdToQuoteIdInterface $maskedQuoteIdToQuoteId
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Wheelpros\Checkout\Model\ResourceModel\CheckoutDummyData $checkoutDummyDataResource,
        \Wheelpros\Checkout\Model\CheckoutDummyDataFactory $checkoutDummyDataFactory,
        \Magento\Quote\Model\MaskedQuoteIdToQuoteIdInterface $maskedQuoteIdToQuoteId,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->checkoutDummyDataResource = $checkoutDummyDataResource;
        $this->checkoutDummyDataFactory  = $checkoutDummyDataFactory;
        $this->maskedQuoteIdToQuoteId    = $maskedQuoteIdToQuoteId;
        $this->logger                    = $logger;
    }

    /**
     * @param string $mask
     * @return int|null
     */
    private function getQuoteIdByMask(string $mask): ?int
    {
        try {
            $id = $this->maskedQuoteIdToQuoteId->execute($mask);
        } catch (Exception $exception) {
            $this->logger->alert($exception);

            return null;
        }

        return $id;
    }

    /**
     * @inheritDoc
     */
    public function saveSubscriptionGuest(bool $status, string $cartId): bool
    {
        $quoteId = $this->getQuoteIdByMask($cartId);
        if (!$quoteId) {
            return false;
        }

        return $this->saveSubscription($status, $quoteId);
    }

    /**
     * @inheritDoc
     */
    public function saveSubscription(bool $status, int $cartId): bool
    {
        /** @var \Wheelpros\Checkout\Model\CheckoutDummyData $model */
        $model = $this->checkoutDummyDataFactory->create();
        $this->checkoutDummyDataResource->load($model, $cartId, 'cart_id');
        $model->setData('email_subscription', $status);
        $model->setData('cart_id', $cartId);

        try {
            $this->checkoutDummyDataResource->save($model);
        } catch (Exception $exception) {
            $this->logger->critical($exception->getMessage());
            $this->logger->critical($exception->getTraceAsString());

            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function getEmailSubscriptionStatusByQuoteId(int $quoteId): bool
    {
        /** @var \Wheelpros\Checkout\Model\CheckoutDummyData $model */
        $model = $this->checkoutDummyDataFactory->create();
        $this->checkoutDummyDataResource->load($model, $quoteId, 'cart_id');
        $subscriptionStatus = (bool)$model->getData('email_subscription');

        return $subscriptionStatus;
    }
}
