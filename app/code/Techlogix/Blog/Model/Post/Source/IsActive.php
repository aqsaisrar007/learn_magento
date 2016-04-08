<?php
namespace Techlogix\Blog\Model\Post\Source;

class IsActive implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Techlogix\Blog\Model\Post
     */
    protected $post;

    /**
     * Constructor
     *
     * @param \Techlogix\Blog\Model\Post $post
     */
    public function __construct(\Techlogix\Blog\Model\Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->post->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}