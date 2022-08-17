<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Improntus\CustomerCode\Model;

use Improntus\CustomerCode\Api\Data\CustomerInterface;
use Magento\Framework\Model\AbstractModel;

class Customer extends AbstractModel implements CustomerInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Improntus\CustomerCode\Model\ResourceModel\Customer::class);
    }

    /**
     * @inheritDoc
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @inheritDoc
     */
    public function getCode()
    {
        return $this->getData(self::CODE);
    }

    /**
     * @inheritDoc
     */
    public function setCode($code)
    {
        return $this->setData(self::CODE, $code);
    }
}

