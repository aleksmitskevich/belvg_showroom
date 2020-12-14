<?php
namespace BelVG\Showroom\Controller\Booking;

use BelVG\Showroom\Helper\Data;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var PageFactory
     */
    protected $pageFactory;

    public function __construct(
        Context $context,
        Data $helperData,
        PageFactory $pageFactory
    )
    {
        parent::__construct($context);
        $this->helperData = $helperData;
        $this->pageFactory = $pageFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Layout|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if (!$this->helperData->isModuleOutputEnabled()) {
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setPath('/');
            return $resultRedirect;
        }
        return $this->pageFactory->create();
    }
}
