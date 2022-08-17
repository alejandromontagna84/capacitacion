<?php


namespace Improntus\Clase3\Model\ResourceModel\SizeChartSizes;

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
            \Improntus\Clase3\Model\SizeChartSizes::class,
            \Improntus\Clase3\Model\ResourceModel\SizeChartSizes::class
        );
    }
}

