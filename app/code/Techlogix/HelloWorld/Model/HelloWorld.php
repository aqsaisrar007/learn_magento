<?php
namespace Techlogix\HelloWorld\Model;
use Magento\Framework\Exception\LocalizedException as CoreException;
class HelloWorld extends \Magento\Framework\Model\AbstractModel
{
	
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Techlogix\HelloWorld\Model\ResourceModel\HelloWorld');
    }
}