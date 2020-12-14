<?php

namespace BelVG\Showroom\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Booking extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'belvg_booking';

    /**
     * @var string
     */
    protected $_cacheTag = 'belvg_booking';

    /**
     * @var string
     */
    protected $_eventPrefix = 'belvg_booking';

    protected function _construct()
    {
        $this->_init('BelVG\Showroom\Model\ResourceModel\Booking');
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
