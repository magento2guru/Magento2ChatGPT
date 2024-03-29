<?php
/**
 * Copyright © Magento2Developer.com All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento2Developer\ChatGPT\Model;

use Magento2Developer\ChatGPT\Api\Data\PromptInterface;
use Magento2Developer\ChatGPT\Api\Data\PromptInterfaceFactory;
use Magento2Developer\ChatGPT\Api\Data\PromptSearchResultsInterfaceFactory;
use Magento2Developer\ChatGPT\Api\PromptRepositoryInterface;
use Magento2Developer\ChatGPT\Model\ResourceModel\Prompt as ResourcePrompt;
use Magento2Developer\ChatGPT\Model\ResourceModel\Prompt\CollectionFactory as PromptCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class PromptRepository implements PromptRepositoryInterface
{

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var PromptInterfaceFactory
     */
    protected $promptFactory;

    /**
     * @var Prompt
     */
    protected $searchResultsFactory;

    /**
     * @var PromptCollectionFactory
     */
    protected $promptCollectionFactory;

    /**
     * @var ResourcePrompt
     */
    protected $resource;


    /**
     * @param ResourcePrompt $resource
     * @param PromptInterfaceFactory $promptFactory
     * @param PromptCollectionFactory $promptCollectionFactory
     * @param PromptSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourcePrompt $resource,
        PromptInterfaceFactory $promptFactory,
        PromptCollectionFactory $promptCollectionFactory,
        PromptSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->promptFactory = $promptFactory;
        $this->promptCollectionFactory = $promptCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(PromptInterface $prompt)
    {
        try {
            $this->resource->save($prompt);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the prompt: %1',
                $exception->getMessage()
            ));
        }
        return $prompt;
    }

    /**
     * @inheritDoc
     */
    public function get($promptId)
    {
        $prompt = $this->promptFactory->create();
        $this->resource->load($prompt, $promptId);
        if (!$prompt->getId()) {
            throw new NoSuchEntityException(__('Prompt with id "%1" does not exist.', $promptId));
        }
        return $prompt;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->promptCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(PromptInterface $prompt)
    {
        try {
            $promptModel = $this->promptFactory->create();
            $this->resource->load($promptModel, $prompt->getPromptId());
            $this->resource->delete($promptModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Prompt: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($promptId)
    {
        return $this->delete($this->get($promptId));
    }
}

