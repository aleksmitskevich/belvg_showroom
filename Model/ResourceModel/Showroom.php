<?php

namespace BelVG\Showroom\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Showroom extends AbstractDb
{
    /**
     * Showroom constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('belvg_showroom', 'showroom_id');
    }
}
