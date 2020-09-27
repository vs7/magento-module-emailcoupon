<?php

class VS7_EmailCoupon_Model_Resource_Customer_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('vs7_emailcoupon/customer');
    }
}