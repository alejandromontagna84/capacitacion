<?php
namespace Improntus\CustomerCode\Observer;

use Magento\Framework\Event\ObserverInterface;
use \Improntus\CustomerCode\Model\CustomerFactory;

class AddCustomerData implements ObserverInterface
{
    public function __construct(
        CustomerFactory $customerFactory
    ){
        $this->customerFactory = $customerFactory;
    }

    public function execute(
        \Magento\Framework\Event\Observer $observer
    ){
        $customer = $observer->getEvent()->getCustomer();
        $id = $customer->getId();
        $model = $this->customerFactory->create();

        $data['code'] = md5($id);
        $data['customer_id'] = $id;
        $data['created_at'] = time();

        $model->setData($data);

        $model->save();
    }
}
