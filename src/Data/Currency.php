<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class Currency
{
    public function __construct(
        public string $code,
        public string $name,
        public string $symbol,
    ) {}

    public static function fromArray(string $code, array $data): self
    {
        return new self(
            code: $code,
            name: $data['name'] ?? '',
            symbol: $data['symbol'] ?? '',
        );
    }
}
