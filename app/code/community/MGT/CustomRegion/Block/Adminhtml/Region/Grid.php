<?php
/**
 * Created by PhpStorm.
 * User: mgtdevelopment
 * Date: 10/21/16
 * Time: 11:43 AM
 */

class MGT_CustomRegion_Block_Adminhtml_Region_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct()
    {
        parent::__construct();
        $this->setId('customregion_region_grid');
        //$this->setUseAjax(true);
        $this->setDefaultSort('region_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('directory/region')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('region_id', [
            'header' => $this->__('ID'),
            'index' => 'region_id'
        ]);

        $this->addColumn('country_id', [
            'header' => $this->__('Country ID'),
            'index' => 'country_id'
        ]);

        $this->addColumn('code', [
            'header' => $this->__('Code'),
            'index' => 'code'
        ]);

        $this->addColumn('default_name', [
            'header' => $this->__('Default name'),
            'index' => 'default_name'
        ]);


        return parent::_prepareColumns();
    }

    public function getRowUrl($item)
    {
        return $this->getUrl('*/*/edit', ['region_id' => $item->getId()]);
    }

    protected function _filterStoreCondition($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }

        $this->getCollection()->addStoreFilter($value);
    }

    protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }
}