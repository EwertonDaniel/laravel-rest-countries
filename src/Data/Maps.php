<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class Maps
{
    public function __construct(
        public string $googleMaps,
        public string $openStreetMaps,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            googleMaps: $data['googleMaps'] ?? '',
            openStreetMaps: $data['openStreetMaps'] ?? '',
        );
    }
}
