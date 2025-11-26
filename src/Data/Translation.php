<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class Translation
{
    public function __construct(
        public string $language,
        public string $official,
        public string $common,
    ) {}

    public static function fromArray(string $language, array $data): self
    {
        return new self(
            language: $language,
            official: $data['official'] ?? '',
            common: $data['common'] ?? '',
        );
    }
}
