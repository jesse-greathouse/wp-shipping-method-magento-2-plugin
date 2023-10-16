<?php


namespace Wheelpros\Info\Observer;

use Magento\Framework\Event\ObserverInterface;

class GetWheelprosOffers implements ObserverInterface
{
    /**
     * @var \Wheelpros\Info\Model\OffersFeedFactory
     */
    protected $feedFactory;

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
     * @param \Wheelpros\Info\Model\UpdatesFeedFactory $feedFactory
     * @param \Wheelpros\Info\Helper\Data $helper
     * @param \Magento\Backend\Model\Auth\Session $backendSession
     */
    public function __construct(
        \Wheelpros\Info\Model\OffersFeedFactory $feedFactory,
        \Wheelpros\Info\Helper\Data $helper,
        \Magento\Backend\Model\Auth\Session $backendSession
    ) {
        $this->feedFactory    = $feedFactory;
        $this->helper         = $helper;
        $this->backendSession = $backendSession;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->backendSession->isLoggedIn()
            && $this->helper->isNotificationExtensionEnabled()
            && $this->helper->isOffersNotificationEnabled()
        ) {
            $feedModel = $this->feedFactory->create();
            /* @var $feedModel \Wheelpros\Info\Model\OffersFeed */
            $feedModel->checkUpdate();
        }
    }
}
