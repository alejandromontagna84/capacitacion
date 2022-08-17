<?php
namespace Improntus\Clase4\Ui\Component\Listing\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use \Magento\Sales\Model\ResourceModel\Order\CollectionFactory;

class Orders extends Column
{
    /**
     *
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        array $components = [],
        array $data = []
    ) {

        $this->_orderCollectionFactory = $orderCollectionFactory;

        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data
        );
    }
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item)
            {
                $collection = $this->_orderCollectionFactory->create()->addFieldToFilter('customer_id', $item['entity_id']);
                $item[$this->getData('name')] = $collection->getSize();
            }
        }
        return $dataSource;
    }
}
