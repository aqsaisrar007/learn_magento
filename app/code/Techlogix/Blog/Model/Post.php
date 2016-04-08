<?php namespace Techlogix\Blog\Model;

use Techlogix\Blog\Api\Data\PostInterface;
use Magento\Framework\DataObject\IdentityInterface;


// IdentityInterface interface is used for models which require cache refresh after creation/updating/deletion, and models that render information to the frontend.
// This simply requires us to implement the getIdentities() method. Which will return a unique ID for each instance of our model, that is cacheable.
class Post  extends \Magento\Framework\Model\AbstractModel implements PostInterface, IdentityInterface  
{

    /**#@+
     * Post's Statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    /**#@-*/

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'blog_post';

    /** @var string
     */
    protected $_cacheTag = 'blog_post';  // a unique identifier for use within caching

    /** Prefix of model events names @var string
     */
    protected $_eventPrefix = 'blog_post'; // a prefix for events to be triggered. 

  /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;
    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $data
     */

    function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [])
    {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
    /** Initialize resource model @return void
     */
    protected function _construct()  // This allows us to initialise our resource model
    {
        $this->_init('Techlogix\Blog\Model\ResourceModel\Post');
    }

    /**
     * Check if post url key exists
     * return post id if post exists
     * @param string $url_key
     * @return int
     */
    public function checkUrlKey($url_key) // This will allow us to check if a post with that URL Key already exists!
    {
        return $this->_getResource()->checkUrlKey($url_key);
    }

    /**
     * Prepare post's statuses.
     * Available event blog_post_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses() // Along with the two constants, we can use this to restrict what statuses can be used.
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::POST_ID);
    }

    /**
     * Get URL Key
     *
     * @return string
     */
    public function getUrlKey()
    {
        return $this->getData(self::URL_KEY);
    }

     /**
     * Return the desired URL of a post
     *  eg: /blog/view/index/id/1/
     * @TODO Move to a PostUrl model, and make use of the
     * @TODO rewrite system, using url_key to build url.
     * @TODO desired url: /blog/my-latest-blog-post-title
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->_urlBuilder->getUrl('blog/' . $this->getUrlKey());
    }

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive()
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return \Techlogix\Blog\Api\Data\PostInterface
     */
    public function setId($id)
    {
        return $this->setData(self::POST_ID, $id);
    }

    /**
     * Set URL Key
     *
     * @param string $url_key
     * @return \Techlogix\Blog\Api\Data\PostInterface
     */
    public function setUrlKey($url_key)
    {
        return $this->setData(self::URL_KEY, $url_key);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return \Techlogix\Blog\Api\Data\PostInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return \Techlogix\Blog\Api\Data\PostInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set creation time
     *
     * @param string $creation_time
     * @return \Techlogix\Blog\Api\Data\PostInterface
     */
    public function setCreationTime($creation_time)
    {
        return $this->setData(self::CREATION_TIME, $creation_time);
    }

    /**
     * Set update time
     *
     * @param string $update_time
     * @return \Techlogix\Blog\Api\Data\PostInterface
     */
    public function setUpdateTime($update_time)
    {
        return $this->setData(self::UPDATE_TIME, $update_time);
    }

    /**
     * Set is active
     *
     * @param int|bool $is_active
     * @return \Techlogix\Blog\Api\Data\PostInterface
     */
    public function setIsActive($is_active)
    {
        return $this->setData(self::IS_ACTIVE, $is_active);
    }

}