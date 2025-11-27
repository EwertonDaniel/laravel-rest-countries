<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class Gini
{
    public function __construct(
        public string $year,
        public float $value,
    ) {}

    public static function fromArray(string $year, float $value): self
    {
        return new self(
            year: $year,
            value: $value,
        );
    }
}