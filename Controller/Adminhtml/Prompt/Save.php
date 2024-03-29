<?php
/**
 * Copyright © Magento2Developer.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento2Developer\ChatGPT\Controller\Adminhtml\Prompt;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
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
            $id = $this->getRequest()->getParam('prompt_id');
        
            $model = $this->_objectManager->create(\Magento2Developer\ChatGPT\Model\Prompt::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Prompt no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Prompt.'));
                $this->dataPersistor->clear('magento2developer_chatgpt_prompt');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['prompt_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Prompt.'));
            }
        
            $this->dataPersistor->set('magento2developer_chatgpt_prompt', $data);
            return $resultRedirect->setPath('*/*/edit', ['prompt_id' => $this->getRequest()->getParam('prompt_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

