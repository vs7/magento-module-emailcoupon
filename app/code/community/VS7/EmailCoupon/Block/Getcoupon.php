<?php

class VS7_EmailCoupon_Block_Getcoupon extends Mage_Core_Block_Template
{
    public function getCouponCode()
    {
        $coupon = Mage::registry('vs7_emailcoupon_coupon');
        if (!empty($coupon)) {
            return $coupon->getCode();
        }
        return null;
    }

    public function getEmail()
    {
        return Mage::registry('vs7_emailcoupon_email');
    }

    public function getDiscountPercent()
    {
        $rule = Mage::helper('vs7_emailcoupon')->getRule();
        if (empty($rule)) {
            return null;
        } else {
            return (int)$rule->getDiscountAmount();
        }
    }

    public function getSendEmailURL()
    {
        $email = $this->getEmail();
        return Mage::getUrl('*/*/sendcoupon', array('_query' => "email=$email"));
    }
}