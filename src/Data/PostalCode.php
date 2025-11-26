<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class PostalCode
{
    public function __construct(
        public string $format,
        public string $regex,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            format: $data['format'] ?? '',
            regex: $data['regex'] ?? '',
        );
    }
}
