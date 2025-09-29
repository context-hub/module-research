<?php

declare(strict_types=1);

namespace Butschster\ContextGenerator\Research\Storage\FileStorage;

/**
 * Configuration for file-based storage driver
 */
final readonly class FileStorageConfig implements \JsonSerializable
{
    public function __construct(
        public string $basePath,
        public string $templatesPath,
        public string $defaultEntryStatus = 'draft',
        public bool $createDirectoriesOnDemand = true,
        public bool $validateTemplatesOnBoot = true,
        public int $maxFileSize = 10485760, // 10MB
        public array $allowedExtensions = ['md', 'yaml'],
        public string $fileEncoding = 'utf-8',
    ) {}

    #[\Override]
    public function jsonSerialize(): array
    {
        return [
            'base_path' => $this->basePath,
            'templates_path' => $this->templatesPath,
            'default_entry_status' => $this->defaultEntryStatus,
            'create_directories_on_demand' => $this->createDirectoriesOnDemand,
            'validate_templates_on_boot' => $this->validateTemplatesOnBoot,
            'max_file_size' => $this->maxFileSize,
            'allowed_extensions' => $this->allowedExtensions,
            'file_encoding' => $this->fileEncoding,
        ];
    }
}
