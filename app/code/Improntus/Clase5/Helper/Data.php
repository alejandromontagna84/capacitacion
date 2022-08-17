<?php
namespace Improntus\Clase5\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    protected $address;

    protected $addressFactory;

    protected $storeManager;

    protected $addressRepositoryInterface;

    protected $pageFactory;

    public function __construct(
        \Magento\Customer\Model\Address $address,
        \Magento\Customer\Model\ResourceModel\AddressFactory $addressFactory,
        \Magento\Customer\Api\AddressRepositoryInterface $addressRepositoryInterface
    )
    {
        $this->addressRepositoryInterface = $addressRepositoryInterface;
        $this->address = $address;
        $this->addressFactory = $addressFactory;
    }

    public function getDni($addressId)
    {
        $attributeCode = "dni";
        $customer = $this->addressRepositoryInterface->getById($addressId);
       return $customer->getCustomAttribute($attributeCode)->getValue();
    }
}
