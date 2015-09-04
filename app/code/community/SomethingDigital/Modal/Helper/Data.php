<?php

class SomethingDigital_Modal_Helper_Data extends Mage_Core_Helper_Abstract
{
    protected $_blockId;

    public function getBlockId()
    {
        if (!$this->_blockId) {
            $this->_blockId = Mage::getStoreConfig('cms/modal/block');
        }
        return $this->_blockId;
    }

}
