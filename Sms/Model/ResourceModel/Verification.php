<?php
namespace Excellence\Sms\Model\ResourceModel;
class Verification extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('sms_order_verification','verification_id');
    }
}
