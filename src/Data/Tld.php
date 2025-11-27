<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class Tld
{
    public function __construct(
        public string $domain,
    ) {}

    public static function fromString(string $domain): self
    {
        return new self(domain: $domain);
    }

    public function __toString(): string
    {
        return $this->domain;
    }
}
