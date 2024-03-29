<?php
/**
 * Copyright © Magento2Developer.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento2Developer\ChatGPT\Model\Config\Source;

class Token implements \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        return [['value' => 'chatgpt-3', 'label' => __('chatgpt-3')],['value' => 'chatgpt-4', 'label' => __('chatgpt-4')]];
    }

    public function toArray()
    {
        return ['chatgpt-3' => __('chatgpt-3'),'chatgpt-4' => __('chatgpt-4')];
    }
}

