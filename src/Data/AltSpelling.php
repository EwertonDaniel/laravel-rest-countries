<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class AltSpelling
{
    public function __construct(
        public string $name,
    ) {}

    public static function fromString(string $name): self
    {
        return new self(name: $name);
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
