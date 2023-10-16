<?php


namespace Wheelpros\Checkout\Plugin;

/**
 * Class Cart
 *
 * Change checkout URL on the cart page
 */
class Cart
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
     * @param \Magento\Checkout\Block\Onepage\Link $subject
     * @param string $result
     * @return string
     */
    public function afterGetCheckoutUrl($subject, $result): string
    {
        if ($this->checkoutConfig->isEnabled()) {
            $result = $subject->getUrl('wheelpros_checkout/onepage');
        }

        return $result;
    }
}
