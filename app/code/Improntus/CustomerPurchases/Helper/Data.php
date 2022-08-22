<?php
namespace Improntus\CustomerPurchases\Helper;
use \Magento\Framework\App\Config\ScopeConfigInterface;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    const XML_PATH_IS_ENABLED = 'customer_purchases/config/active';

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ){
        $this->scopeConfig = $scopeConfig;
    }



    public function getIsEnabled() {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_IS_ENABLED, $storeScope);
    }
}
