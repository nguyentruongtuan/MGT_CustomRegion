<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 10/22/16
 * Time: 2:26 PM
 */

class MGT_CustomRegion_Block_Adminhtml_Region_Edit_Form extends Mage_Adminhtml_Block_Widget_Form{

    protected $_modelCode = 'current_directory_region';

	protected function _prepareForm() {
        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getUrl('*/*/save'), 'method' => 'post')
        );

        $fieldSet = $form->addFieldset('general', [
            'legend' => $this->__('Region details')
        ]);

        $model = $this->_getEditModel();

        $fieldSet->addField('region_id', 'hidden', [
            'name' => 'region_id'
        ]);

        $fieldSet->addField('country_id', 'text', [
            'label' => $this->__('Country ID'),
            'title' => $this->__('Country ID'),
            'name' => 'country_id',
            'required' => true
        ]);

        $fieldSet->addField('code', 'text', [
            'label' => $this->__('Code'),
            'title' => $this->__('Code'),
            'name' => 'code',
            'required' => true
        ]);

        $fieldSet->addField('default_name', 'text', [
            'label' => $this->__('Default Name'),
            'title' => $this->__('Default Name'),
            'name' => 'default_name',
            'required' => true
        ]);

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        return $this;
	}

    protected function _getEditModel() {
        if(!$this->hasData($this->_modelCode)) {
            $model = Mage::registry($this->_modelCode);
            $this->setData($this->_modelCode, $model);
        }

        return $this->getData($this->_modelCode);
    }
}