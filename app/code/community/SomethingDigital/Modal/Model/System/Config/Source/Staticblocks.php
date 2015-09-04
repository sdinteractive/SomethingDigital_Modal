<?php

class SomethingDigital_Modal_Model_System_Config_Source_Staticblocks
{
    public function toOptionArray()
    {
        $collection = Mage::getResourceModel('cms/block_collection');
        $options = array();
        $i = 0;
        foreach ($collection as $item) {
            $options[$i]['value'] = $item->getData('identifier');
            $options[$i]['label'] = $item->getData('title'); 
            $i++;
        }
       return $options;
    }
}
