<?php


namespace Wheelpros\Checkout\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class OrderComment
 *
 * Entity for temporary storage of comments.
 */
class OrderComment extends AbstractModel
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init(\Wheelpros\Checkout\Model\ResourceModel\OrderComment::class);
        $this->setIdFieldName('id');
    }
}
