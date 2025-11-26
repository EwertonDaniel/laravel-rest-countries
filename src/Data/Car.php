<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class Car
{
    /**
     * @param  string[]  $signs
     */
    public function __construct(
        public array $signs,
        public string $side,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            signs: $data['signs'] ?? [],
            side: $data['side'] ?? '',
        );
    }
}
