<?php


namespace Improntus\Clase3\Model;

use Magento\Framework\Model\AbstractModel;

class SizeChartSizes extends AbstractModel
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Improntus\Clase3\Model\ResourceModel\SizeChartSizes::class);
    }
}

