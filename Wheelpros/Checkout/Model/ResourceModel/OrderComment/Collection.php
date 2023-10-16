<?php


namespace Wheelpros\Checkout\Model\ResourceModel\OrderComment;

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
            \Wheelpros\Checkout\Model\OrderComment::class,
            \Wheelpros\Checkout\Model\ResourceModel\OrderComment::class
        );
        $this->_setIdFieldName('id');
    }
}
