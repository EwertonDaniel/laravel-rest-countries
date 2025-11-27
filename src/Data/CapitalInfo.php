<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class CapitalInfo
{
    public function __construct(
        public Coordinates $coordinates,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            coordinates: Coordinates::fromArray($data['latlng'] ?? []),
        );
    }

    public function getLatitude(): ?float
    {
        return $this->coordinates->latitude;
    }

    public function getLongitude(): ?float
    {
        return $this->coordinates->longitude;
    }
}
