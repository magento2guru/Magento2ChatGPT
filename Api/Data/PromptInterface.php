<?php
/**
 * Copyright © Magento2Developer.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento2Developer\ChatGPT\Api\Data;

interface PromptInterface
{

    const MODEL = 'model';
    const PROMPT = 'prompt';
    const PROMPT_ID = 'prompt_id';
    const LABEL = 'label';

    /**
     * Get prompt_id
     * @return string|null
     */
    public function getPromptId();

    /**
     * Set prompt_id
     * @param string $promptId
     * @return \Magento2Developer\ChatGPT\Prompt\Api\Data\PromptInterface
     */
    public function setPromptId($promptId);

    /**
     * Get model
     * @return string|null
     */
    public function getModel();

    /**
     * Set model
     * @param string $model
     * @return \Magento2Developer\ChatGPT\Prompt\Api\Data\PromptInterface
     */
    public function setModel($model);

    /**
     * Get label
     * @return string|null
     */
    public function getLabel();

    /**
     * Set label
     * @param string $label
     * @return \Magento2Developer\ChatGPT\Prompt\Api\Data\PromptInterface
     */
    public function setLabel($label);

    /**
     * Get prompt
     * @return string|null
     */
    public function getPrompt();

    /**
     * Set prompt
     * @param string $prompt
     * @return \Magento2Developer\ChatGPT\Prompt\Api\Data\PromptInterface
     */
    public function setPrompt($prompt);
}

