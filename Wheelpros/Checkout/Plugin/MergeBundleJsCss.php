<?php


namespace Wheelpros\Checkout\Plugin;

use Magento\Framework\View\Asset\ConfigInterface;

class MergeBundleJsCss
{
    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $request;

    /**
     * @var \Wheelpros\Checkout\Api\CheckoutConfigInterface
     */
    private $checkoutConfig;

    /**
     * MergeBundleJsCss constructor.
     *
     * @param \Magento\Framework\App\Request\Http $request
     */
    public function __construct(
        \Magento\Framework\App\Request\Http $request,
        \Wheelpros\Checkout\Api\CheckoutConfigInterface $checkoutConfig
    ) {
        $this->request = $request;
        $this->checkoutConfig = $checkoutConfig;
    }

    /**
     * @param ConfigInterface $subject
     * @param $result
     * @return bool
     */
    public function afterIsMergeCssFiles(ConfigInterface $subject, $result)
    {
        if ($this->isWheelprosCheckoutPage()) {
            $result = $result || $this->checkoutConfig->isMergeJsCssEnabled();
        }

        return $result;
    }

    /**
     * @param ConfigInterface $subject
     * @param $result
     * @return bool
     */
    public function afterIsBundlingJsFiles(ConfigInterface $subject, $result)
    {
        if ($this->isWheelprosCheckoutPage()) {
            $result = $result || $this->checkoutConfig->isMergeJsCssEnabled();
        }

        return $result;
    }

    /**
     * @param ConfigInterface $subject
     * @param $result
     * @return bool
     */
    public function afterIsMergeJsFiles(ConfigInterface $subject, $result)
    {
        if ($this->isWheelprosCheckoutPage()) {
            $result = $result || $this->checkoutConfig->isMergeJsCssEnabled();
        }

        return $result;
    }

    /**
     * @return bool
     */
    private function isWheelprosCheckoutPage(): bool
    {
        return $this->request->getRouteName() == 'wheelpros_checkout';
    }
}
