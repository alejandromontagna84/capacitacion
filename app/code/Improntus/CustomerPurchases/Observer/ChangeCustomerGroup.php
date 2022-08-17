<?php
namespace Improntus\CustomerPurchases\Observer;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\CustomerFactory;
class ChangeCustomerGroup implements ObserverInterface
{
    public function __construct(
        StoreManagerInterface $storeManager,
        CollectionFactory $orderCollectionFactory,
        CustomerFactory $customerFactory
    ){
        $this->storeManager = $storeManager;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->customerFactory = $customerFactory;
    }

    public function execute(
        \Magento\Framework\Event\Observer $observer
    ){
        $websiteId = $this->storeManager->getStore()->getWebsiteId();

        $order = $observer->getEvent()->getOrder();
        $customerId = $order->getCustomerId();
        $ordersByCustomer = $this->orderCollectionFactory->create();
        $ordersByCustomer->addFieldToFilter('customer_id', $customerId);
        $ordersQty = $ordersByCustomer->count();

        $newCustomerGroupId = $ordersQty > 4 ? 5 : 4;

        $customerFactory = $this->customerFactory->create();
        $customer = $customerFactory->setWebsiteId($websiteId)->loadByEmail($order->getCustomerEmail());
        $customer->setWebsiteId($websiteId)->setData('group_id', $newCustomerGroupId);
        $customer->save();
    }
}
