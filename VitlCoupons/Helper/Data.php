<?php

namespace DavidMorales\VitlCoupons\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    const CONFIG_PATH = 'vitlconfiguration/';

    public function getConfigOptions($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::CONFIG_PATH . 'options/' . $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    public function getModuleStatus($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::CONFIG_PATH . 'status/status', ScopeInterface::SCOPE_STORE, $storeId
        );
    }

}
