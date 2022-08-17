<?php

namespace Improntus\Clase3\Ui\Component\Listing\Column;
use \Improntus\Clase3\Model\SizeChartFactory;

class SizeChart extends \Magento\Ui\Component\Listing\Columns\Column {

    protected $sizeChartFactory;

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Improntus\Clase3\Model\SizeChartFactory $sizeChartFactory,
        array $components = [],
        array $data = []
    ){
        $this->sizeChartFactory = $sizeChartFactory;
        parent::__construct(
            $context,
            $uiComponentFactory,
            $components, $data
        );
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $model = $this->sizeChartFactory->create();
                $sizeChart = $model->load($item['size_chart_id']);
                $item['size_chart_id'] = "{$sizeChart->getTitle()} ({$sizeChart->getId()})";
            }
        }
        return $dataSource;
    }
}
