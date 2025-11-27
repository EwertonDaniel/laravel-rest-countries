<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class Coordinates
{
    public function __construct(
        public ?float $latitude,
        public ?float $longitude,
    ) {}

    public static function fromArray(array $latlng): self
    {
        return new self(
            latitude: $latlng[0] ?? null,
            longitude: $latlng[1] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([$this->latitude, $this->longitude], fn ($v) => $v !== null);
    }
}
