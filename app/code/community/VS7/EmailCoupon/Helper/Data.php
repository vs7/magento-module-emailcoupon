<?php

class VS7_EmailCoupon_Helper_Data extends Mage_Core_Helper_Abstract
{
    private $_rule;

    public function getCoupon($email)
    {
        $coupon = null;
        if (!empty($email)) {
            $customerCoupon = Mage::getModel('vs7_emailcoupon/customer')->loadByEmail($email);

            if ($customerCoupon->getId() == null) {
                $rule = $this->getRule();
                if ($rule->getId() == null) {
                    return null;
                } else {
                    if (Mage::getStoreConfig('vs7_emailcoupon/general/subscribed')) {
                        $subscriber = Mage::getModel('newsletter/subscriber')->loadByEmail($email);
                        if ($subscriber->getId() == null) {
                            return null;
                        }
                    }

                    $allCoupons = Mage::getModel('vs7_emailcoupon/customer')->getCollection()->getColumnValues('coupon_id');
                    $collection = Mage::getResourceModel('salesrule/coupon_collection')
                        ->addRuleToFilter($rule);
                    if (!empty($allCoupons)) {
                        $collection->addFieldToFilter('coupon_id', array('nin' => $allCoupons));
                    }
                    $coupon = $collection
                        ->getFirstItem();

                    if ($coupon->getId() !== null) {
                        $customerCoupon
                            ->setCouponId($coupon->getCouponId())
                            ->save();
                    }
                }
            } else {
                $coupon = Mage::getModel('salesrule/coupon')->load($customerCoupon->getCouponId());
            }
        }

        return $coupon;
    }

    public function getRule()
    {
        if (empty($this->_rule)) {
            $this->_rule = Mage::getModel('salesrule/rule')->load(Mage::getStoreConfig('vs7_emailcoupon/general/rule_id'));
        }

        return $this->_rule;
    }
}