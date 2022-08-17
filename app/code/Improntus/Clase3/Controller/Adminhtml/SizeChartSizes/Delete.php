<?php

namespace Improntus\Clase3\Controller\Adminhtml\SizeChartSizes;
use \Improntus\Clase3\Model\SizeChartSizesFactory;

class Delete extends \Improntus\Clase3\Controller\Adminhtml\SizeChartSizes
{

    protected $sizeChartSizesFactory;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Improntus\Clase3\Model\SizeChartSizesFactory $sizeChartSizesFactory
    ) {
        $this->sizeChartSizesFactory = $sizeChartSizesFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct(
            $context,
            $coreRegistry
        );
    }
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('entity_id');
        if ($id) {
            try {
                $model = $this->sizeChartSizesFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the Sizechart Size %1',$id));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a Sizechart to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}

