<?php


namespace Improntus\Clase3\Controller\Adminhtml\SizeChart;
use \Improntus\Clase3\Model\SizeChartFactory;

class Edit extends \Improntus\Clase3\Controller\Adminhtml\SizeChart
{

    protected $resultPageFactory;
    protected $sizeChartFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Improntus\Clase3\Model\SizeChartFactory $sizeChartFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Improntus\Clase3\Model\SizeChartFactory $sizeChartFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->sizeChartFactory = $sizeChartFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        $model = $this->sizeChartFactory->create();
        $sizeChart = $model->load($id);

        if ($id) {
            $sizeChart->load($id);
            if (!$sizeChart->getId()) {
                $this->messageManager->addErrorMessage(__('This Sizechart no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('improntus_clase3_sizechart', $sizeChart);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Sizechart') : __('New Sizechart'),
            $id ? __('Edit Sizechart') : __('New Sizechart')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Sizecharts'));
        $resultPage->getConfig()->getTitle()->prepend($sizeChart->getId() ? __('Edit Sizechart %1', $model->getId()) : __('New Sizechart'));
        return $resultPage;
    }
}

