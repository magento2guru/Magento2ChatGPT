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
use Magento\Framework\Controller\ResultInterface;
use Magento\Store\Model\ScopeInterface;

class Image extends Action
{

    protected $request;
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context              $context,
        Http                 $request,
        ScopeConfigInterface $scopeConfig
    )
    {
        parent::__construct($context);
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

        $response = $this->generateImage($data['prompt']);

        if (empty($response['error'])) {
            $image = imagecreatefrompng((string) $this->generateImage($data['prompt']));
            imagejpeg($image, null, 30);
            imagedestroy($image);
            return $this->getResponse()->setHeader('Content-Type', 'image/jpeg');
        }

        return $this->getResponse()->setBody(json_encode($response));
    }

    private function generateImage($prompt)
    {
        $client = new Client();
        $token = $this->scopeConfig->getValue('magento2developer/chatgpt/token', ScopeInterface::SCOPE_STORE);
        $modelImage = $this->scopeConfig->getValue('magento2developer/chatgpt/model_image', ScopeInterface::SCOPE_STORE);

        try {
            $response = $client->request('POST', 'https://api.openai.com/v1/images/generations', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.$token,
                ],
                'json' => [
                    "model" => $modelImage,
                    'prompt' => $prompt,
                    "n" => 1,
                    "style" => 'vivid'
                ]
            ]);

            $response = json_decode((string)$response->getBody(), true);

            return $response['data'][0]['url'];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
