<?php

class VS7_EmailCoupon_Model_Resource_Customer extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('vs7_emailcoupon/customer', 'id');
    }
}