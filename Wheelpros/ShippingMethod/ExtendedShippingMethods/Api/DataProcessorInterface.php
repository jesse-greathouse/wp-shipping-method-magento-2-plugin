<?php


namespace Wheelpros\ExtendedShippingMethods\Api;

interface DataProcessorInterface
{
    /**
     * @param \Magento\Quote\Api\Data\ShippingMethodInterface $method
     * @return void
     */
    public function processShippingMethodAsAnObject(\Magento\Quote\Api\Data\ShippingMethodInterface $method);

    /**
     * @param array $method
     * @return void
     */
    public function processShippingMethodAsAnArray(array &$method);
}
