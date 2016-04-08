<?php
namespace Techlogix\Blog\Model\ResourceModel;

/**
 * Blog post mysql resource
 */
class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * Construct
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param string|null $resourcePrefix
     */

    // inject dependencies we use in our resource model
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        $this->_date = $date;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()  // initialise our resource model, this is where the database table and ID column is defined
    {
        $this->_init('techlogix_blog_post', 'post_id');
    }

    /**
     * Process post data before saving
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object) // we need to make sure we’re saving valid data, so a little validation is handled Here
    {

        if (!$this->isValidPostUrlKey($object)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('The post URL key contains capital letters or disallowed symbols.')
            );
        }

        if ($this->isNumericPostUrlKey($object)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('The post URL key cannot be made of only numbers.')
            );
        }

        if ($object->isObjectNew() && !$object->hasCreationTime()) {
            $object->setCreationTime($this->_date->gmtDate());
        }

        $object->setUpdateTime($this->_date->gmtDate());

        return parent::_beforeSave($object);
    }

    /**
     * Load an object using 'url_key' field if there's no field specified and value is not numeric
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @param mixed $value
     * @param string $field
     * @return $this
     */
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null) //if the user provides a string instead of an id we try to load the model against
                                                                                               // the url_key column as that is still a uniquely identifiable column.
    {
        if (!is_numeric($value) && is_null($field)) {
            $field = 'url_key';
        }

        return parent::load($object, $value, $field);
    }

    /**
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @param \Techlogix\Blog\Model\Post $object
     * @return \Zend_Db_Select
     */
    protected function _getLoadSelect($field, $value, $object) //allows us to filter to only active posts. We don’t want to load inactive posts!
    { 
        $select = parent::_getLoadSelect($field, $value, $object);

        if ($object->getStoreId()) {

            $select->where(
                'is_active = ?',
                1
            )->limit(
                1
            );
        }

        return $select;
    }

    /**
     * Retrieve load select with filter by url_key and activity
     *
     * @param string $url_key
     * @param int $isActive
     * @return \Magento\Framework\DB\Select
     */
    protected function _getLoadByUrlKeySelect($url_key, $isActive = null)  //allows us to select items by a url key.
    {
        $select = $this->getConnection()->select()->from(
            ['bp' => $this->getMainTable()]
        )->where(
            'bp.url_key = ?',
            $url_key
        );

        if (!is_null($isActive)) {
            $select->where('bp.is_active = ?', $isActive);
        }

        return $select;
    }

    /**
     *  Check whether post url key is numeric
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return bool
     */
    protected function isNumericPostUrlKey(\Magento\Framework\Model\AbstractModel $object) //a validation method to see if our url key contains numbers. We don’t want numeric url keys!
    {
        return preg_match('/^[0-9]+$/', $object->getData('url_key'));
    }

    /**
     *  Check whether post url key is valid
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return bool
     */
    protected function isValidPostUrlKey(\Magento\Framework\Model\AbstractModel $object)  //make sure the post url key is actually valid with a simple regex check.
    {
        return preg_match('/^[a-z0-9][a-z0-9_\/-]+(\.[a-z0-9_-]+)?$/', $object->getData('url_key'));
    }

    /**
     * Check if post url key exists
     * return post id if post exists
     *
     * @param string $url_key
     * @return int
     */
    public function checkUrlKey($url_key)  // check if a URL Key exists in the posts table already
    {
        $select = $this->_getLoadByUrlKeySelect($url_key, 1);
        $select->reset(\Zend_Db_Select::COLUMNS)->columns('bp.post_id')->limit(1);

        return $this->getConnection()->fetchOne($select);
    }
}