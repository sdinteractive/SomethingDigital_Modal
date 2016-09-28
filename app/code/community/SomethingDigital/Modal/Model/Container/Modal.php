<?php

class SomethingDigital_Modal_Model_Container_Modal extends Enterprise_PageCache_Model_Container_Abstract
{
    protected function _getCacheId()
    {
        return 'SOMETHINGDIGITAL_MODAL_MODAL_CACHE' . md5($this->_placeholder->getAttribute('cache_id')) . '_' . $this->_getCookieValue(Enterprise_PageCache_Model_Cookie::COOKIE_CUSTOMER, '');
    }

    protected function _renderBlock()
    {
        $blockClass = $this->_placeholder->getAttribute('block');;
        $template = $this->_placeholder->getAttribute('template');
        $block = new $blockClass;
        $block->setTemplate($template);
        $block->setLayout(Mage::app()->getLayout());
        return $block->toHtml();
    }
}
