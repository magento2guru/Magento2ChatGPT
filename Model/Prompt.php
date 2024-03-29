<?php
/**
 * Copyright © Magento2Developer.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento2Developer\ChatGPT\Model;

use Magento2Developer\ChatGPT\Api\Data\PromptInterface;
use Magento\Framework\Model\AbstractModel;

class Prompt extends AbstractModel implements PromptInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Magento2Developer\ChatGPT\Model\ResourceModel\Prompt::class);
    }

    /**
     * @inheritDoc
     */
    public function getPromptId()
    {
        return $this->getData(self::PROMPT_ID);
    }

    /**
     * @inheritDoc
     */
    public function setPromptId($promptId)
    {
        return $this->setData(self::PROMPT_ID, $promptId);
    }

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        return $this->getData(self::MODEL);
    }

    /**
     * @inheritDoc
     */
    public function setModel($model)
    {
        return $this->setData(self::MODEL, $model);
    }

    /**
     * @inheritDoc
     */
    public function getLabel()
    {
        return $this->getData(self::LABEL);
    }

    /**
     * @inheritDoc
     */
    public function setLabel($label)
    {
        return $this->setData(self::LABEL, $label);
    }

    /**
     * @inheritDoc
     */
    public function getPrompt()
    {
        return $this->getData(self::PROMPT);
    }

    /**
     * @inheritDoc
     */
    public function setPrompt($prompt)
    {
        return $this->setData(self::PROMPT, $prompt);
    }
}

