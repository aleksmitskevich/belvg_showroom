<?php

namespace BelVG\Showroom\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Showroom extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'belvg_showroom';

    /**
     * @var string
     */
    protected $_cacheTag = 'belvg_showroom';

    /**
     * @var string
     */
    protected $_eventPrefix = 'belvg_showroom';

    protected function _construct()
    {
        $this->_init('BelVG\Showroom\Model\ResourceModel\Showroom');
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
