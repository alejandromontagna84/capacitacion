<?php
namespace Improntus\Clase4\Ui\Component\Listing\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use \Magento\Sales\Api\OrderRepositoryInterface;

class Products extends Column
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
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        array $components = [],
        array $data = []
    ) {

        $this->orderRepository = $orderRepository;

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
            foreach ($dataSource['data']['items'] as & $item){
                $order  = $this->orderRepository->get($item["entity_id"]);
                $orderItems = $order->getAllItems();
                $item[$this->getData('name')] = count($orderItems);
            }
        }
        return $dataSource;
    }
}
