<?php


namespace Wheelpros\Checkout\Plugin;

use Magento\Framework\Exception\LocalizedException;

class AddLayoutProcessorAfterAll
{
    /**
     * @var \Magento\Framework\Serialize\SerializerInterface
     */
    private $serializer;

    /**
     * @var \Wheelpros\Checkout\Block\Checkout\Onepage\LayoutProcessorFactory
     */
    private $layoutProcessorFactory;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * AddLayoutProcessorAfterAll constructor.
     *
     * @param \Wheelpros\Checkout\Block\Checkout\Onepage\LayoutProcessorFactory $layoutProcessorFactory
     * @param \Magento\Framework\Serialize\SerializerInterface $serializer
     */
    public function __construct(
        \Wheelpros\Checkout\Block\Checkout\Onepage\LayoutProcessorFactory $layoutProcessorFactory,
        \Magento\Framework\Serialize\SerializerInterface $serializer,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->layoutProcessorFactory = $layoutProcessorFactory;
        $this->serializer             = $serializer;
        $this->logger                 = $logger;
    }

    /**
     * @param \Magento\Checkout\Block\Onepage $subject
     * @param string $jsLayoutSerialized
     * @return bool|string
     */
    public function afterGetJsLayout(\Magento\Checkout\Block\Onepage $subject, string $jsLayoutSerialized)
    {
        $jsLayout = $this->serializer->unserialize($jsLayoutSerialized);

        try {
            /** @var \Wheelpros\Checkout\Block\Checkout\Onepage\LayoutProcessor $wheelprosCheckoutLayoutProcessor */
            $wheelprosCheckoutLayoutProcessor = $this->layoutProcessorFactory->create();
            $jsLayout                        = $wheelprosCheckoutLayoutProcessor->process($jsLayout);
        } catch (LocalizedException $e) {
            $this->logger->emergency($e->getLogMessage());
        } finally {
            $jsLayoutSerializedAndUpdated = $this->serializer->serialize($jsLayout);
        }

        return $jsLayoutSerializedAndUpdated;
    }
}
