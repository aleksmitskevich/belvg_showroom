<?php

namespace BelVG\Showroom\Model\ResourceModel\Showroom;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'showroom_id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'belvg_showroom_collection';

    /**
     * @var string
     */
    protected $_eventObject = 'showroom_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('BelVG\Showroom\Model\Showroom', 'BelVG\Showroom\Model\ResourceModel\Showroom');
    }
}
