<?php

namespace Improntus\Clase3\Controller\Adminhtml\SizeChart;

use Magento\Framework\Exception\LocalizedException;
use \Improntus\Clase3\Model\SizeChartFactory;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;
    protected $sizeChartFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param \Improntus\Clase3\Model\SizeChartFactory $sizeChartFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Improntus\Clase3\Model\SizeChartFactory $sizeChartFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->sizeChartFactory = $sizeChartFactory;
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
            $model = $this->sizeChartFactory->create();
            $sizeChart = $model->load($id);
            if (!$sizeChart->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Sizechart no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $data['created_at'] = time();

            $sizeChart->setData($data);

            try {
                $sizeChart->save();
                $this->messageManager->addSuccessMessage(__('You saved the Sizechart.'));
                $this->dataPersistor->clear('improntus_clase3_sizechart');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['entity_id' => $sizeChart->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Sizechart.'));
            }

            $this->dataPersistor->set('improntus_clase3_sizechart', $data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('entity_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

