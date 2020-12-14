<?php

namespace BelVG\Showroom\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use BelVG\Showroom\Model\ResourceModel\Showroom\Collection;
use BelVG\Showroom\Helper\Data;

class Booking extends Template
{
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * Construct
     *
     * @param Data $helperData
     * @param Collection $collection
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Data $helperData,
        Collection $collection,
        Context $context,
        array $data = []
    ) {
        $this->collection = $collection;
        $this->helperData = $helperData;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('showroom/booking/save', ['_secure' => false]);
    }

    /**
     * @return Collection|null
     */
    public function getShowrooms()
    {
        $showrooms = $this->collection->getItems();
        if (!empty($showrooms)) {
            return $showrooms;
        }
        return null;
    }

    /**
     * @return \Magento\Customer\Model\Customer|null
     */
    public function getCustomer()
    {
        if ($customer = $this->helperData->getCustomer()) {
            return $customer;
        }
        return null;
    }
}
