<?php


namespace Wheelpros\Checkout\Model\ResourceModel\CheckoutDummyData;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Set resource model and determine field mapping
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Wheelpros\Checkout\Model\CheckoutDummyData::class,
            \Wheelpros\Checkout\Model\ResourceModel\CheckoutDummyData::class
        );
        $this->_setIdFieldName('id');
    }
}
