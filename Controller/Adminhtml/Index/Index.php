<?php
/**
 * Copyright © Magento2Developer.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento2Developer\ChatGPT\Controller\Adminhtml\Index;

use GuzzleHttp\Client;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Store\Model\ScopeInterface;

class Index extends Action
{

    /**
     * @var JsonFactory
     */
    protected $jsonResultFactory;

    protected $request;
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context              $context,
        JsonFactory          $jsonResultFactory,
        Http                 $request,
        ScopeConfigInterface $scopeConfig
    )
    {
        parent::__construct($context);
        $this->jsonResultFactory = $jsonResultFactory;
        $this->request = $request;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $data = json_decode($this->request->getContent(), true);

        $result = $this->jsonResultFactory->create();

        $data = ['message' => $this->chatComplete($data['prompt'])];

        $result->setData($data);
        return $result;
    }

    private function chatComplete($prompt)
    {
        $client = new Client();
        $token = $this->scopeConfig->getValue('magento2developer/chatgpt/token', ScopeInterface::SCOPE_STORE);
        $model = $this->scopeConfig->getValue('magento2developer/chatgpt/model', ScopeInterface::SCOPE_STORE);

        try {
            $response = $client->request('POST', 'https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.$token,
                ],
                'json' => [
                    "model" => $model,
                    'messages' => [
                        [
                            'role' => 'user',
                            "content" => $prompt
                        ]
                    ]
                ]
            ]);

            $response = json_decode((string)$response->getBody(), true);
            return $response['choices'][0]['message']['content'];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
