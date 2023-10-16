<?php


namespace Wheelpros\Checkout\Block\Html;

use Magento\Framework\View\Element\Template;
use Wheelpros\Checkout\Api\CheckoutConfigInterface;

class Header extends Template
{
    /**
     * @var CheckoutConfigInterface
     */
    private $checkoutConfig;

    /**
     * Header constructor.
     *
     * @param Template\Context $context
     * @param CheckoutConfigInterface $checkoutConfig
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CheckoutConfigInterface $checkoutConfig,
        array $data = []
    ) {
        $this->checkoutConfig = $checkoutConfig;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getCheckoutTitle(): ?string
    {
        return $this->checkoutConfig->getCheckoutPageTitle();
    }
}
