<?php

namespace Improntus\Clase3\Controller\Adminhtml\SizeChartSizes;

use Magento\Framework\Exception\LocalizedException;
use \Improntus\Clase3\Model\SizeChartSizesFactory;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;
    protected $sizeChartSizesFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param \Improntus\Clase3\Model\SizeChartSizesFactory $sizeChartSizesFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Improntus\Clase3\Model\SizeChartSizesFactory $sizeChartSizesFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->sizeChartSizesFactory = $sizeChartSizesFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('entity_id');
            $model = $this->sizeChartSizesFactory->create();
            $sizeChartSizes = $model->load($id);
            if (!$sizeChartSizes->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Sizechart Size no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $sizeChartSizes->setData($data);

            try {
                $sizeChartSizes->save();
                $this->messageManager->addSuccessMessage(__('You saved the Sizechart Sizes.'));
                $this->dataPersistor->clear('improntus_clase3_sizechartsizes');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['entity_id' => $sizeChartSizes->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Sizechart.'));
            }

            $this->dataPersistor->set('improntus_clase3_sizechartsizes', $data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('entity_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

