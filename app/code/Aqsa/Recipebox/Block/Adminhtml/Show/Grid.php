<?php
 
namespace Aqsa\Recipebox\Block\Adminhtml\Show;
 
class Grid extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Aqsa_Recipebox';
        $this->_controller = 'adminhtml_show';
        $this->_headerText = __('Recipebox');
        $this->_addButtonLabel = __('Add New Recipe');
        parent::_construct();
         $this->addColumn('image', array(
		'header' => __('Recipebox')->__('Image'),
		'index' => 'image',
		 'renderer' => 'Aqsa_Recipebox_Block_Adminhtml_Renderer_Image',
		));
    }
}