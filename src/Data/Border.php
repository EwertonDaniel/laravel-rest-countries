<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class Border
{
    public function __construct(
        public string $countryCode,
    ) {}

    public static function fromString(string $countryCode): self
    {
        return new self(countryCode: $countryCode);
    }

    public function __toString(): string
    {
        return $this->countryCode;
    }
}
