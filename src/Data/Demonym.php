<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class Demonym
{
    public function __construct(
        public string $language,
        public string $female,
        public string $male,
    ) {}

    public static function fromArray(string $language, array $data): self
    {
        return new self(
            language: $language,
            female: $data['f'] ?? '',
            male: $data['m'] ?? '',
        );
    }
}
