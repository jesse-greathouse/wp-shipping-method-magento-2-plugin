<?php


namespace Wheelpros\Info\Model;

class OffersFeed extends AbstractFeed
{
    /**
     * @var string
     */
    const CACHE_IDENTIFIER = 'wheelpros_offers_notifications_lastcheck';

    /**
     * Feed url
     * @var string
     */
    protected $_feedUrl = \Wheelpros\Info\Helper\Data::WHEELPROS_SITE . '/infoprovider/index/offers';
}
