<?php


namespace Improntus\Clase3\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class SizeChart extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('size_chart', 'entity_id');
    }
}

