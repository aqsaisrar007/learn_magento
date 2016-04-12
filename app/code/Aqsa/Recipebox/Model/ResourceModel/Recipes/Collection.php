<?php
namespace Aqsa\Recipebox\Model\ResourceModel\Recipes;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Aqsa\Recipebox\Model\Recipes', 'Aqsa\Recipebox\Model\ResourceModel\Recipes');
    }
}