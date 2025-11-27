<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class Language
{
    public function __construct(
        public string $code,
        public string $name,
    ) {}

    public static function fromArray(string $code, string $name): self
    {
        return new self(
            code: $code,
            name: $name,
        );
    }
}