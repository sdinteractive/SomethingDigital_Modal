<?php

class SomethingDigital_Modal_Block_Modal extends Mage_Core_Block_Template
{
    const CONFIG_PREFIX = 'cms/modal/';

    public function getConfig($value) 
    {
        return Mage::getStoreConfig(self::CONFIG_PREFIX . $value);
    }

    public function getModalContent() 
    {
        $blockId = $this->getConfig('block');
        $output = $this->getLayout()->createBlock('cms/block')->setBlockId($blockId)->toHtml();
        return str_replace(array("\r", "\n"), "", addslashes($output));
    }

    public function getIsAlreadySubscribed()
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            $email = $customer->getEmail();
            $subscriber = Mage::getModel('newsletter/subscriber')->loadByEmail($email);
            if ($subscriber->getId()) {
                return 1;
            }
            return 0;
        }
        return 0;
    }

    public function getIsAlreadyLoggedIn()
    {
       if (Mage::getSingleton('customer/session')->isLoggedIn()) {
               return 1;
       }
       return 0;
    }

}
