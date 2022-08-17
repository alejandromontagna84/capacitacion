<?php

namespace Improntus\Clase3\Block\Index;
use \Improntus\Clase3\Model\SizeChartSizesFactory;

class Index extends \Magento\Framework\View\Element\Template
{

    protected $sizeChartSizesFactory;
    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param \Improntus\Clase3\Model\SizeChartSizesFactory $sizeChartSizesFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Improntus\Clase3\Model\SizeChartSizesFactory $sizeChartSizesFactory,
        array $data = []
    ) {
        $this->sizeChartSizesFactory = $sizeChartSizesFactory;
        parent::__construct($context, $data);
    }

    public function getSizes()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->sizeChartSizesFactory->create();
        $sizesCollection = $model->getCollection()->addFieldToFilter('size_chart_id', $id);
        return $sizesCollection;

    }
}
