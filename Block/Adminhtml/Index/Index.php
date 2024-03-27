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

class Index extends Template
{
    private Data $catalogHelper;

    /**
     * Constructor
     *
     * @param Context  $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $catalogHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->catalogHelper = $catalogHelper;
    }

    public function getCurrentProductLanguage() {
        $countryCode = $this->_scopeConfig->getValue('general/locale/code', ScopeInterface::SCOPE_STORE, $this->catalogHelper->getProduct()->getStore()->getCode());
        return  \Locale::getDisplayLanguage($countryCode);
    }
}
