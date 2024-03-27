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
        return [['value' => 'chatgpt-3', 'label' => __('ChatGPT 3')],['value' => 'chatgpt-4', 'label' => __('ChatGPT 4')]];
    }
}
