<?php
namespace Techlogix\HelloWorld\Model\ResourceModel\HelloWorld;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Techlogix\HelloWorld\Model\HelloWorld', 'Techlogix\HelloWorld\Model\ResourceModel\HelloWorld');
    }
}