<?php
 
namespace Techlogix\HelloWorld\Block\Adminhtml\Employee;
 
class Grid extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Techlogix_HelloWorld';
        $this->_controller = 'adminhtml_employee';
        $this->_headerText = __('Employee');
        $this->_addButtonLabel = __('Add New Employee');
        parent::_construct();
        $this->buttonList->add(
            'employee_apply',
            [
                'label' => __('Employee'),
                'onclick' => "location.href='" . $this->getUrl('Employee/*/applyEmployee') . "'",
                'class' => 'apply'
            ]
        );
    }
}