<?php


namespace Improntus\Clase3\Model\ResourceModel\SizeChart;

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
            \Improntus\Clase3\Model\SizeChart::class,
            \Improntus\Clase3\Model\ResourceModel\SizeChart::class
        );
    }
}

