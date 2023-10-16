<?php


namespace Wheelpros\Info\Model;

class UpdatesFeed extends AbstractFeed
{
    /**
     * @var string
     */
    const CACHE_IDENTIFIER = 'wheelpros_updates_notifications_lastcheck';

    /**
     * Feed url
     *
     * @var string
     */
    protected $_feedUrl =  \Wheelpros\Info\Helper\Data::WHEELPROS_SITE . '/infoprovider/index/updates';
}
