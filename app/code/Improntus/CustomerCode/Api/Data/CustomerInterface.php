<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Improntus\CustomerCode\Api\Data;

interface CustomerInterface
{

    const CODE = 'code';
    const CUSTOMER_ID = 'customer_id';

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Improntus\CustomerCode\Customer\Api\Data\CustomerInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get code
     * @return string|null
     */
    public function getCode();

    /**
     * Set code
     * @param string $code
     * @return \Improntus\CustomerCode\Customer\Api\Data\CustomerInterface
     */
    public function setCode($code);
}

