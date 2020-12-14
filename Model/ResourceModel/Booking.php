<?php

namespace BelVG\Showroom\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Booking extends AbstractDb
{
    /**
     * Booking constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('belvg_booking_showroom', 'booking_id');
    }
}
