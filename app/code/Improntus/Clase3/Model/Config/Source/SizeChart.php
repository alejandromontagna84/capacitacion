<?php
namespace Improntus\Clase3\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use \Improntus\Clase3\Model\SizeChartFactory;

class SizeChart implements ArrayInterface
{
    protected $sizeChartSizesFactory;
    /**
     * @param \Improntus\Clase3\Model\SizeChartFactory $sizeChartFactory
     */
    public function __construct(
        \Improntus\Clase3\Model\SizeChartFactory $sizeChartFactory
    )
    {
        $this->sizeChartFactory = $sizeChartFactory;
    }

    public function toOptionArray()
    {
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                'value' => $value,
                'label' => $label,
            ];
        }

        return $result;
    }

    public function getOptions()
    {
        $model = $this->sizeChartFactory->create();
        $sizeCharts = $model->getCollection();
        $options = array();
        foreach ($sizeCharts as $sizeChart){
            $options[$sizeChart->getEntityId()] = $sizeChart->getTitle();
        }
        return $options;
    }
}
