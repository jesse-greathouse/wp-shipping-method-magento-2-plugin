<?php


namespace Wheelpros\Checkout\Model;

use Magento\Framework\Model\AbstractModel;

class CheckoutDummyData extends AbstractModel
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init(\Wheelpros\Checkout\Model\ResourceModel\CheckoutDummyData::class);
        $this->setIdFieldName('id');
    }
}
