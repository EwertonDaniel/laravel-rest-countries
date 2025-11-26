<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class CapitalInfo
{
    /**
     * @param  float[]  $latlng
     */
    public function __construct(
        public array $latlng = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            latlng: $data['latlng'] ?? [],
        );
    }

    public function getLatitude(): ?float
    {
        return $this->latlng[0] ?? null;
    }

    public function getLongitude(): ?float
    {
        return $this->latlng[1] ?? null;
    }
}
