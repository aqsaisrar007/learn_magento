<?php namespace Techlogix\Blog\Model\ResourceModel\Post;

//The collection model will allow us to filter and fetch a collection of blog posts.

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'post_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Techlogix\Blog\Model\Post', 'Techlogix\Blog\Model\ResourceModel\Post');
    }

}