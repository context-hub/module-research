<?php

declare(strict_types=1);

namespace Butschster\ContextGenerator\Research\Service;

use Butschster\ContextGenerator\Research\Domain\Model\Entry;
use Butschster\ContextGenerator\Research\Domain\ValueObject\EntryId;
use Butschster\ContextGenerator\Research\Domain\ValueObject\ResearchId;
use Butschster\ContextGenerator\Research\Exception\EntryNotFoundException;
use Butschster\ContextGenerator\Research\Exception\ResearchException;
use Butschster\ContextGenerator\Research\Exception\ResearchNotFoundException;
use Butschster\ContextGenerator\Research\Exception\TemplateNotFoundException;
use Butschster\ContextGenerator\Research\MCP\DTO\EntryCreateRequest;
use Butschster\ContextGenerator\Research\MCP\DTO\EntryUpdateRequest;

/**
 * Service interface for entry operations
 */
interface EntryServiceInterface
{
    /**
     * Create a new entry in the specified research
     *
     * Creates an entry with title, description, content, and metadata.
     * Description is auto-generated from content if not provided.
     *
     * @throws ResearchNotFoundException
     * @throws TemplateNotFoundException
     * @throws ResearchException
     */
    public function createEntry(ResearchId $researchId, EntryCreateRequest $request): Entry;

    /**
     * Update an existing entry
     *
     * Updates entry fields including title, description, content, status, and tags.
     * Supports partial updates - only provided fields are modified.
     *
     * @throws ResearchNotFoundException
     * @throws EntryNotFoundException
     * @throws ResearchException
     */
    public function updateEntry(ResearchId $researchId, EntryId $entryId, EntryUpdateRequest $request): Entry;

    /**
     * Check if an entry exists
     */
    public function entryExists(ResearchId $researchId, EntryId $entryId): bool;

    /**
     * Get a specific entry by ID
     *
     * @throws ResearchNotFoundException
     * @throws ResearchException
     */
    public function getEntry(ResearchId $researchId, EntryId $entryId): ?Entry;

    /**
     * Get entries for a research with optional filtering
     *
     * Supports filtering by title, description, category, type, status, tags, and content.
     * Returns entries with full metadata including description for LLM understanding.
     *
     * @return Entry[]
     */
    public function findAll(ResearchId $researchId, array $filters = []): array;

    /**
     * Delete an entry
     *
     */
    public function deleteEntry(ResearchId $researchId, EntryId $entryId): bool;
}
