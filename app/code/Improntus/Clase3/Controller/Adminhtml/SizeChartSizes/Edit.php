<?php


namespace Improntus\Clase3\Controller\Adminhtml\SizeChartSizes;
use \Improntus\Clase3\Model\SizeChartSizesFactory;

class Edit extends \Improntus\Clase3\Controller\Adminhtml\SizeChartSizes
{

    protected $resultPageFactory;
    protected $sizeChartSizesFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Improntus\Clase3\Model\SizeChartSizesFactory $sizeChartSizesFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Improntus\Clase3\Model\SizeChartSizesFactory $sizeChartSizesFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->sizeChartSizesFactory = $sizeChartSizesFactory;
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
        $model = $this->sizeChartSizesFactory->create();
        $sizeChartSizes = $model->load($id);

        if ($id) {
            if (!$sizeChartSizes->getId()) {
                $this->messageManager->addErrorMessage(__('This Sizechart no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('improntus_clase3_sizechartsizes', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Sizechart Size') : __('New Sizechart Size'),
            $id ? __('Edit Sizechart Size') : __('New Sizechart Size')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Sizecharts Sizes'));
        $resultPage->getConfig()->getTitle()->prepend($sizeChartSizes->getId() ? __('Edit Sizechart Size %1', $sizeChartSizes->getId()) : __('New Sizechart Size'));
        return $resultPage;
    }
}

