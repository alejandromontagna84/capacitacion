<?php
namespace Improntus\CustomerPurchases\Helper;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
    * @var \Magento\Framework\App\Config\ScopeConfigInterface
    */
    protected $scopeConfig;

    /**
    * Recipient email config path
    */
    const XML_PATH_IS_ENABLED = 'customer_purchases/config/active';

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }



    public function getIsEnabled() {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_IS_ENABLED, $storeScope);
    }
}
