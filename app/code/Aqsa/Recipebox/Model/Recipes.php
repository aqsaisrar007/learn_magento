<?php
namespace Aqsa\Recipebox\Model;
use Magento\Framework\Exception\LocalizedException as CoreException;
class Recipes extends \Magento\Framework\Model\AbstractModel
{
	
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Aqsa\Recipebox\Model\ResourceModel\Recipes');
    }
}