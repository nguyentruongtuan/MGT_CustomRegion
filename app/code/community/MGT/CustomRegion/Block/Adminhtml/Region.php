<?php
/**
 * Created by PhpStorm.
 * User: mgtdevelopment
 * Date: 10/21/16
 * Time: 11:43 AM
 */

class MGT_CustomRegion_Block_Adminhtml_Region extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function _construct()
    {

        $this->_controller = 'adminhtml_region';
        $this->_blockGroup = 'customregion';
        $this->_headerText = $this->__('Manage Region');
        parent::_construct();
    }

    
}
