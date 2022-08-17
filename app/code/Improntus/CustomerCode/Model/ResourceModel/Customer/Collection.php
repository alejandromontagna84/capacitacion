<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Improntus\CustomerCode\Model\ResourceModel\Customer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'entity_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Improntus\CustomerCode\Model\Customer::class,
            \Improntus\CustomerCode\Model\ResourceModel\Customer::class
        );
    }
}

