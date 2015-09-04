<?php

class SomethingDigital_Modal_Block_Modal extends Mage_Core_Block_Template
{
    const CONFIG_PREFIX = 'cms/modal/';

    public function getConfig($value) {
        return Mage::getStoreConfig(self::CONFIG_PREFIX . $value);
    }

    public function getModalContent() {
        $blockId = $this->getConfig('block');
        $output = $this->getLayout()->createBlock('cms/block')->setBlockId($blockId)->toHtml();
        return str_replace(array("\r", "\n"), "", addslashes($output));
    }
}
