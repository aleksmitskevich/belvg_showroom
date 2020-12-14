<?php
namespace BelVG\Showroom\Controller\Booking;

use BelVG\Showroom\Model\BookingFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\DataObject;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Escaper;
use BelVG\Showroom\Helper\Data;

class Save extends Action
{
    /**
     * @var BookingFactory
     */
    protected $bookingFactory;

    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;

    /**
     * @var Escaper
     */
    protected $escaper;

    /**
     * @var Data
     */
    protected $helperData;

    /**
     * Save constructor.
     * @param Data $helperData
     * @param BookingFactory $bookingFactory
     * @param TransportBuilder $transportBuilder
     * @param Escaper $escaper
     * @param Context $context
     */
    public function __construct(
        Data $helperData,
        BookingFactory $bookingFactory,
        TransportBuilder $transportBuilder,
        Escaper $escaper,
        Context $context
    )
    {
        parent::__construct($context);
        $this->bookingFactory = $bookingFactory;
        $this->transportBuilder = $transportBuilder;
        $this->escaper = $escaper;
        $this->helperData = $helperData;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Layout
     * @throws \Exception
     */
    public function execute()
    {
        $data = (array) $this->getRequest()->getPost();
        if (!empty($data)) {
            try {
                $booking = $this->bookingFactory->create()->setData($data);
                $booking->save();
                $this->sendEmailToAdmin($data);
                $this->messageManager->addSuccessMessage('Booking done!');
            } catch (LocalizedException $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage('Something went wrong during booking.');
            }
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('showroom/booking');
        return $resultRedirect;
    }

    /**
     * @param $data
     */
    private function sendEmailToAdmin($data)
    {
        $sender = [
            'name' => $this->escaper->escapeHtml($data['customer_name']),
            'email' => $this->escaper->escapeHtml($data['customer_email']),
        ];
        $postObject = new DataObject();
        $postObject->setData($data);
        try {
            $transport =
                $this->transportBuilder
                    ->setTemplateIdentifier('showroom_booking_email_template')
                    ->setTemplateOptions(
                        ['area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                            'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,]
                    )
                    ->setTemplateVars(['data' => $postObject])
                    ->setFrom($sender)
                    ->addTo($this->helperData->getRecipient())
                    ->getTransport();
            $transport->sendMessage();
        } catch (LocalizedException $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
