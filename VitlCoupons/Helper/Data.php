<?php

namespace DavidMorales\VitlCoupons\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    const CONFIG_PATH = 'vitlconfiguration/';

    /**
     * @param string $field
     * @param int|null $storeId
     * @return mixed
     */
    public function getConfigOptions(string $field, int $storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::CONFIG_PATH . 'options/' . $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /**
     * @param int|null $storeId
     * @return mixed
     */
    public function getModuleStatus(int $storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::CONFIG_PATH . 'status/status', ScopeInterface::SCOPE_STORE, $storeId
        );
    }



}
