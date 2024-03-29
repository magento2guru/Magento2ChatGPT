<?php
/**
 * Copyright © Magento2Developer.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento2Developer\ChatGPT\Api\Data;

interface PromptSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Prompt list.
     * @return \Magento2Developer\ChatGPT\Api\Data\PromptInterface[]
     */
    public function getItems();

    /**
     * Set model list.
     * @param \Magento2Developer\ChatGPT\Api\Data\PromptInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

