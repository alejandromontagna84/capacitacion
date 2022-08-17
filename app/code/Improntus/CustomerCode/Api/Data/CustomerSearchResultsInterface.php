<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Improntus\CustomerCode\Api\Data;

interface CustomerSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Customer list.
     * @return \Improntus\CustomerCode\Api\Data\CustomerInterface[]
     */
    public function getItems();

    /**
     * Set code list.
     * @param \Improntus\CustomerCode\Api\Data\CustomerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

