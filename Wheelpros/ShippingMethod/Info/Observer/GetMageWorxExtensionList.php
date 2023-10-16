<?php


namespace Wheelpros\Info\Observer;

use Magento\Framework\Event\ObserverInterface;

class GetWheelprosExtensionList implements ObserverInterface
{
    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $backendSession;

    /**
     * @var \Wheelpros\Info\Helper\Data
     */
    protected $helper;

    /**
     * GetWheelprosOffers constructor.
     *
     * @param \Wheelpros\Info\Helper\Data $helper
     * @param \Magento\Backend\Model\Auth\Session $backendSession
     */
    public function __construct(
        \Wheelpros\Info\Helper\Data $helper,
        \Magento\Backend\Model\Auth\Session $backendSession
    ) {
        $this->helper         = $helper;
        $this->backendSession = $backendSession;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->backendSession->isLoggedIn() && $this->helper->isExtensionInfoAutoloadEnabled()) {
            $this->helper->checkExtensionListUpdate();
        }
    }
}
