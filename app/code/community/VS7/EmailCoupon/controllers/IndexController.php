<?php

class VS7_EmailCoupon_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function getcouponAction()
    {
        $this->_init();

        $this->loadLayout();
        $this->renderLayout();
    }

    public function sendcouponAction()
    {
        $this->_init();

        $discount = Mage::helper('vs7_emailcoupon')->getRule()->getDiscountAmount() + 0;

        $emailTemplate = Mage::getModel('core/email_template')->loadDefault('vs7_emailcoupon');
        if ($emailTemplate->getId()) {
            $email = Mage::registry('vs7_emailcoupon_email');
            $coupon = Mage::registry('vs7_emailcoupon_coupon')->getCode();

            $emailTemplate->sendTransactional($emailTemplate->getId(), 'support', $email, '', array(
                'coupon' => $coupon,
                'discount' => $discount
            ), 0);
        }

        $url = Mage::getUrl('*/*/getcoupon', array('_query' => "email=$email"));
        $this->getResponse()->setRedirect($url)->sendResponse();
    }

    protected function _init()
    {
        $email = Mage::app()->getRequest()->getParam('email');
        preg_match('/(^[^\?]+)\??/', $email, $matches);
        $email = $matches[1];
        if (empty($email)) {
            $this->norouteAction();
            return $this;
        };
        Mage::register('vs7_emailcoupon_email', $email);

        $coupon = Mage::helper('vs7_emailcoupon')->getCoupon($email);
        if (empty($coupon)) {
            $this->norouteAction();
            return $this;
        }
        Mage::register('vs7_emailcoupon_coupon', $coupon);
    }
}