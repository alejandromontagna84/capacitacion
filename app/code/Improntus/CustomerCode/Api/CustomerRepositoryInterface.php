<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Improntus\CustomerCode\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CustomerRepositoryInterface
{

    /**
     * Save Customer
     * @param \Improntus\CustomerCode\Api\Data\CustomerInterface $customer
     * @return \Improntus\CustomerCode\Api\Data\CustomerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Improntus\CustomerCode\Api\Data\CustomerInterface $customer
    );

    /**
     * Retrieve Customer
     * @param string $customerId
     * @return \Improntus\CustomerCode\Api\Data\CustomerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($customerId);

    /**
     * Retrieve Customer matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Improntus\CustomerCode\Api\Data\CustomerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Customer
     * @param \Improntus\CustomerCode\Api\Data\CustomerInterface $customer
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Improntus\CustomerCode\Api\Data\CustomerInterface $customer
    );

    /**
     * Delete Customer by ID
     * @param string $customerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($customerId);
}

