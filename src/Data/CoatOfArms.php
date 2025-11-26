<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class CoatOfArms
{
    public function __construct(
        public string $png,
        public string $svg,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            png: $data['png'] ?? '',
            svg: $data['svg'] ?? '',
        );
    }
}
