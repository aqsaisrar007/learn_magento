<?php
namespace Techlogix\HelloWorld\Model\ResourceModel;
 
class HelloWorld extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('techlogix_helloworld_test', 'test_id');
    }
}