<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 10/22/16
 * Time: 2:27 PM
 */

class MGT_CustomRegion_Block_Adminhtml_Region_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{

    protected $_objectId = 'region_id'; // allow to delete

    public function __construct()
    {
        $this->_blockGroup = 'customregion';
        $this->_controller = 'adminhtml_region';
        parent::__construct();

        $this->_updateButton('delete', 'label', Mage::helper('customregion')->__('Delete Region'));
        /**
         * The $_mode property tells Magento which folder to use
         * to locate the related form blocks to be displayed in
         * this form container. In our example, this corresponds
         * to BrandDirectory/Block/Adminhtml/Brand/Edit/.
         */
        $this->_mode = 'edit';

        $action = $this->getRequest()->getParam('region_id')
            ? $this->__('Edit')
            : $this->__('New');
        $this->_headerText =  $action . ' ' . $this->__('Directory Region');

    }
    
}