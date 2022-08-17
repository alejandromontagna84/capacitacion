<?php
namespace Improntus\CustomerPurchases\Observer;
use \Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
class ChangeCustomerGroup implements ObserverInterface
{
    public function __construct(
        CollectionFactory $orderCollectionFactory,
        CustomerRepositoryInterface $customerRepository
    ){
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->customerRepository = $customerRepository;
    }

    public function execute(
        \Magento\Framework\Event\Observer $observer
    ){
        $order = $observer->getEvent()->getOrder();
        $customerId = $order->getCustomerId();
        $ordersByCustomer =  $this->orderCollectionFactory->create();
        $ordersByCustomer->addFieldToFilter('customer_id', $customerId);
        $ordersQty = $ordersByCustomer->count();
        if ($ordersQty > 5){
            $customer = $this->customerRepository->getById($customerId);
            $customer->setData('group_id', 27);
            $customer->save();
        }

    }
}
