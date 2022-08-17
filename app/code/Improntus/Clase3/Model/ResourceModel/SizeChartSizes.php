<?php


namespace Improntus\Clase3\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class SizeChartSizes extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('size_chart_sizes', 'entity_id');
    }
}

