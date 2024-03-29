<?php
/**
 * Copyright © Magento2Developer.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento2Developer\ChatGPT\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PromptRepositoryInterface
{

    /**
     * Save Prompt
     * @param \Magento2Developer\ChatGPT\Api\Data\PromptInterface $prompt
     * @return \Magento2Developer\ChatGPT\Api\Data\PromptInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Magento2Developer\ChatGPT\Api\Data\PromptInterface $prompt
    );

    /**
     * Retrieve Prompt
     * @param string $promptId
     * @return \Magento2Developer\ChatGPT\Api\Data\PromptInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($promptId);

    /**
     * Retrieve Prompt matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento2Developer\ChatGPT\Api\Data\PromptSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Prompt
     * @param \Magento2Developer\ChatGPT\Api\Data\PromptInterface $prompt
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Magento2Developer\ChatGPT\Api\Data\PromptInterface $prompt
    );

    /**
     * Delete Prompt by ID
     * @param string $promptId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($promptId);
}

