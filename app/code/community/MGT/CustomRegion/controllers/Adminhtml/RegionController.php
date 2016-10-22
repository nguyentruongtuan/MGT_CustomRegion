<?php
/**
 * Created by PhpStorm.
 * User: mgtdevelopment
 * Date: 10/21/16
 * Time: 11:24 AM
 */

class MGT_CustomRegion_Adminhtml_RegionController extends Mage_Adminhtml_Controller_Action {

    public function _initRegion() {
        $this->_title($this->__('Directory'))
            ->_title($this->__('Manage Region'));
        $id = (int)$this->getRequest()->getParam('id');
        $model = Mage::getModel('directory/region');

        if($id) {
            $model->load($id);
        }

        Mage::register('current_directory_region', $model);
        return $model;
    }

    public function indexAction() {
        $this->loadLayout();
        $this->_setActiveMenu('customregion/region');
        $block = $this->getLayout()->createBlock('customregion/adminhtml_region');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function editAction() {

        $id = (int)$this->getRequest()->getParam('region_id');
        $model = Mage::getModel('directory/region')->load($id);

        $this->loadLayout();

        if(!!$model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

            if(!empty($data)) {
                $model->setData($data);
            }

            Mage::register('current_directory_region', $model);

            $this->_addContent($this->getLayout()->createBlock('customregion/adminhtml_region_edit'));
        }

        $this->renderLayout();
    }

    public function saveAction() {
        // check if data sent
        if ($data = $this->getRequest()->getPost()) {

            $id = $this->getRequest()->getParam('region_id');
            $model = Mage::getModel('directory/region')->load($id);
            if (!$model->getId() && $id) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('customregion')->__('This region no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }

            if(!$model->getId()) {
                unset($data['region_id']);
            }

            // init model and set data

            $model->setData($data);

            // try to save it
            try {
                // save the data
                $model->save();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('customregion')->__('The region has been saved.'));
                // clear previously saved data from session
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('region_id' => $model->getId()));
                    return;
                }
                // go to grid
                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // save data in session
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                // redirect to edit form
                $this->_redirect('*/*/edit', array('block_id' => $this->getRequest()->getParam('region_id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * Delete action
     */
    public function deleteAction()
    {
        // check if we know what should be deleted
        if ($id = $this->getRequest()->getParam('region_id')) {
            $title = "";
            try {
                // init model and delete
                $model = Mage::getModel('directory/region');
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('customregion')->__('The region has been deleted.'));
                // go to grid
                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // go back to edit form
                $this->_redirect('*/*/edit', array('region_id' => $id));
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('customregion')->__('Unable to find a region to delete.'));
        // go to grid
        $this->_redirect('*/*/');
    }


    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('customregion/region');
    }

}