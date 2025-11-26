<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class Idd
{
    /**
     * @param  string[]  $suffixes
     */
    public function __construct(
        public string $root,
        public array $suffixes = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            root: $data['root'] ?? '',
            suffixes: $data['suffixes'] ?? [],
        );
    }

    public function getFullCode(): string
    {
        if (empty($this->suffixes)) {
            return $this->root;
        }

        return $this->root.$this->suffixes[0];
    }
}
