<?php

namespace Improntus\CustomerCode\Observer;

use Magento\Framework\Event\ObserverInterface;
use \Magento\Customer\Api\CustomerRepositoryInterface;
use \Improntus\CustomerCode\Model\CustomerFactory;
class AddCustomerData implements ObserverInterface
{
    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface,
        CustomerFactory $customerFactory
    ){
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->customerFactory = $customerFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $id = $customer->getId();
        $model = $this->customerFactory->create();


        $data['customer_id'] = $id;
        $data['created_at'] = time();

        $model->setData($data);

        $model->save();
        //\Magento\Framework\App\ObjectManager::getInstance()->get(\Psr\Log\LoggerInterface::class)->debug($customer->getFirstname());
    }
}
