<?php
namespace Aqsa\Recipebox\Model\ResourceModel;
 
class Recipes extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('recipes', 'recipe_id');
    }
}