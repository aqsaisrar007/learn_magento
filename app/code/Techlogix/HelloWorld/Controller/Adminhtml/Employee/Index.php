<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Techlogix\HelloWorld\Controller\Adminhtml\Employee;
use Magento\Framework\Controller\ResultFactory;
class Index extends \Techlogix\HelloWorld\Controller\Adminhtml\Employee
{
    public function execute()
    {
       $resultPage = $this->_initAction();
        $resultPage->getConfig()->getTitle()->prepend(__('QTV'));
        return $resultPage;
    }
}
