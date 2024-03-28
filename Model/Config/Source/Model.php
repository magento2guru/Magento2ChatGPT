<?php
/**
 * Copyright © Magento2Developer.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento2Developer\ChatGPT\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Model implements OptionSourceInterface
{

    public function toOptionArray()
    {
        return [
            ['value' => 'gpt-3.5-turbo', 'label' => __('GPT 3')],
            ['value' => 'gpt-4-turbo-preview', 'label' => __('GPT 4 Turbo Preview')],
            ['value' => 'gpt-4', 'label' => __('GPT 4')],
            ['value' => 'gpt-4-32k', 'label' => __('GPT 4 32K')]
        ];
    }
}
