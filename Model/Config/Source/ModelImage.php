<?php
/**
 * Copyright © Magento2Developer.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento2Developer\ChatGPT\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class ModelImage implements OptionSourceInterface
{

    public function toOptionArray()
    {
        return [['value' => 'dall-e-3', 'label' => __('Dall E 3')]];
    }
}
