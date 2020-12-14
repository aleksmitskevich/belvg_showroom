<?php

namespace BelVG\Showroom\Model\ResourceModel\Booking;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'booking_id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'belvg_booking_collection';

    /**
     * @var string
     */
    protected $_eventObject = 'booking_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('BelVG\Showroom\Model\Booking', 'BelVG\Showroom\Model\ResourceModel\Booking');
    }
}
