<?php

namespace BelVG\Showroom\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Customer\Model\Session;

class Data extends AbstractHelper
{
    const IS_ENABLED_PATH = 'showroom/general/enable';

    /**
     * @var Session
     */
    protected $customerSession;

    public function __construct(
        Context $context,
        Session $customerSession
    )
    {
        parent::__construct($context);
        $this->customerSession = $customerSession;
    }

    /**
     * @param null $storeId
     * @return bool|mixed
     */
    public function isModuleOutputEnabled($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::IS_ENABLED_PATH, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /**
     * @return \Magento\Customer\Model\Customer|null
     */
    public function getCustomer()
    {
        if ($this->customerSession->isLoggedIn()) {
            return $this->customerSession->getCustomer();
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->scopeConfig->getValue('trans_email/ident_support/email',ScopeInterface::SCOPE_STORE);
    }
}
