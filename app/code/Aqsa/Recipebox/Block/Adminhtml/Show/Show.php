<?php
namespace Aqsa\Recipebox\Block\Adminhtml\Show;

class Show extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_show';
        $this->_blockGroup = 'Aqsa_Recipebox';
        $this->_headerText = __('Manage Recipes');
        parent::_construct();
        $this->buttonList->update('add', 'label', __('Add New Recipe'));
    }

}
