<?php

class VS7_EmailCoupon_Model_Customer extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('vs7_emailcoupon/customer');
    }

    public function loadByEmail($email)
    {
        $customer = Mage::getModel('customer/customer');
        $customer->setWebsiteId(Mage::app()->getStore()->getWebsiteId());
        $customer->loadByEmail($email);
        if ($customer->getId()) {
            $this->load($customer->getId(), 'customer_id');
        }
        $this->setCustomerId($customer->getId());

        return $this;
    }
}