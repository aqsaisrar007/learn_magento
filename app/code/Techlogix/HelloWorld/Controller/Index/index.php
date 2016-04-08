<?php 
namespace Techlogix\HelloWorld\Controller\Index;

use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    /**      * @param \Magento\Framework\App\Action\Context $context      */
    /**      * @param \Magento\Framework\View\Result\PageFactory resultPageFactory */
    public function __construct(\Magento\Framework\App\Action\Context $context,PageFactory $resultPageFactory) /* Context gives you access to things like: the object manager, the URL model, and more. 
                                                                                                                  $resultPageFactory factory object to handle the creation of our result page
                                                                                                                  This object is all we need to call to render our page */
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);  // ensure that parent method is still executed
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        //$resultPage->getConfig()->getTitle()->prepend(__('Hello World'));
        return $resultPage;        
    }
}