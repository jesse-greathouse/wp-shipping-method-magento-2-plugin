<?php


namespace Wheelpros\Checkout\Plugin;

/**
 * Class Sidebar
 *
 * Change checkout URL in the mini-cart
 */
class Sidebar
{
    /**
     * @var \Wheelpros\Checkout\Api\CheckoutConfigInterface
     */
    private $checkoutConfig;

    /**
     * Cart constructor.
     *
     * @param \Wheelpros\Checkout\Api\CheckoutConfigInterface $checkoutConfig
     */
    public function __construct(
        \Wheelpros\Checkout\Api\CheckoutConfigInterface $checkoutConfig
    ) {
        $this->checkoutConfig = $checkoutConfig;
    }

    /**
     * @param \Magento\Checkout\Block\Cart\Sidebar $subject
     * @param array $result
     * @return array
     */
    public function afterGetConfig($subject, $result): array
    {
        if ($this->checkoutConfig->isEnabled()) {
            $result['checkoutUrl'] = $subject->getUrl('wheelpros_checkout/onepage');
        }

        return $result;
    }
}
