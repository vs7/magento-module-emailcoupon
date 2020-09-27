<?php
$installer = $this;

$installer->startSetup();

$installer->run("
CREATE TABLE IF NOT EXISTS {$this->getTable('vs7_emailcoupon')} (
  `id` INT(10) NOT NULL AUTO_INCREMENT,
  `customer_id` INT(10) NOT NULL,
  `coupon_id` INT(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();