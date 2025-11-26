<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class NativeName
{
    public function __construct(
        public string $official,
        public string $common,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            official: $data['official'] ?? '',
            common: $data['common'] ?? '',
        );
    }
}
