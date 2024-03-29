<?php
/**
 * Copyright © Magento2Developer.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento2Developer\ChatGPT\Block\Adminhtml\Index;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Helper\Data;
use Magento\Store\Model\ScopeInterface;
use Magento2Developer\ChatGPT\Model\Prompt;
use Magento2Developer\ChatGPT\Model\PromptRepository;
use Magento2Developer\ChatGPT\Model\ResourceModel\Prompt\CollectionFactory;

class Index extends Template
{
    private Data $catalogHelper;

    private CollectionFactory $promptCollectionFactory;

    /**
     * Constructor
     *
     * @param Context  $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $catalogHelper,
        CollectionFactory $promptCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->catalogHelper = $catalogHelper;

        $this->promptCollectionFactory = $promptCollectionFactory;
    }

    public function getCurrentProductLanguage() {
        $countryCode = $this->_scopeConfig->getValue('general/locale/code', ScopeInterface::SCOPE_STORE, $this->catalogHelper->getProduct()->getStore()->getCode());
        return  \Locale::getDisplayLanguage($countryCode);
    }

    public function buildPromptMap($model = 'product') : array {
        $promptCollection = $this->promptCollectionFactory->create();
        $promptCollection->addFilter('model',$model)->load();

        $promptArray = [];

        foreach ($promptCollection as $prompt)
        {
            if (empty($promptArray[$prompt->getModel()])) $promptArray[$prompt->getModel()] = [];
            $promptArray[$prompt->getModel()][$prompt->getLabel()] = $prompt->getPrompt();
        }

        return $promptArray;
    }
}
