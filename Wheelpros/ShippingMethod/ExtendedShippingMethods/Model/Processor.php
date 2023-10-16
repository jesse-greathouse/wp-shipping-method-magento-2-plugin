<?php


namespace Wheelpros\ExtendedShippingMethods\Model;

/**
 * Class Processor
 *
 * Adds additional data to the shipping methods using processors
 *
 */
class Processor
{
    /**
     * @var \Wheelpros\ExtendedShippingMethods\Api\DataProcessorInterface[]
     */
    protected $processors = [];

    /**
     * Processor constructor.
     *
     * @param \Wheelpros\ExtendedShippingMethods\Api\DataProcessorInterface[] $processors
     */
    public function __construct(
        array $processors = []
    ) {
        $this->processors = $processors;
    }

    /**
     * @param \Magento\Quote\Api\Data\ShippingMethodInterface|array $shippingMethod
     */
    public function process($shippingMethod)
    {
        if ($shippingMethod instanceof \Magento\Quote\Api\Data\ShippingMethodInterface) {
            foreach ($this->processors as $dataProcessor) {
                $dataProcessor->processShippingMethodAsAnObject($shippingMethod);
            }

            return;
        }

        if (is_array($shippingMethod)) {
            foreach ($this->processors as $dataProcessor) {
                $dataProcessor->processShippingMethodAsAnArray($shippingMethod);
            }

            return;
        }
    }
}
