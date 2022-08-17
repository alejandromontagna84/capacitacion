<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Improntus\CustomerCode\Model;

use Improntus\CustomerCode\Api\CustomerRepositoryInterface;
use Improntus\CustomerCode\Api\Data\CustomerInterface;
use Improntus\CustomerCode\Api\Data\CustomerInterfaceFactory;
use Improntus\CustomerCode\Api\Data\CustomerSearchResultsInterfaceFactory;
use Improntus\CustomerCode\Model\ResourceModel\Customer as ResourceCustomer;
use Improntus\CustomerCode\Model\ResourceModel\Customer\CollectionFactory as CustomerCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class CustomerRepository implements CustomerRepositoryInterface
{

    /**
     * @var ResourceCustomer
     */
    protected $resource;

    /**
     * @var CustomerInterfaceFactory
     */
    protected $customerFactory;

    /**
     * @var CustomerCollectionFactory
     */
    protected $customerCollectionFactory;

    /**
     * @var Customer
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceCustomer $resource
     * @param CustomerInterfaceFactory $customerFactory
     * @param CustomerCollectionFactory $customerCollectionFactory
     * @param CustomerSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceCustomer $resource,
        CustomerInterfaceFactory $customerFactory,
        CustomerCollectionFactory $customerCollectionFactory,
        CustomerSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->customerFactory = $customerFactory;
        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(CustomerInterface $customer)
    {
        try {
            $this->resource->save($customer);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customer: %1',
                $exception->getMessage()
            ));
        }
        return $customer;
    }

    /**
     * @inheritDoc
     */
    public function get($customerId)
    {
        $customer = $this->customerFactory->create();
        $this->resource->load($customer, $customerId);
        if (!$customer->getId()) {
            throw new NoSuchEntityException(__('Customer with id "%1" does not exist.', $customerId));
        }
        return $customer;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->customerCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(CustomerInterface $customer)
    {
        try {
            $customerModel = $this->customerFactory->create();
            $this->resource->load($customerModel, $customer->getCustomerId());
            $this->resource->delete($customerModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Customer: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($customerId)
    {
        return $this->delete($this->get($customerId));
    }
}

