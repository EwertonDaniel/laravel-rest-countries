<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class CountryName
{
    /**
     * @param  array<string, NativeName>  $nativeName
     */
    public function __construct(
        public string $common,
        public string $official,
        public array $nativeName = [],
    ) {}

    public static function fromArray(array $data): self
    {
        $nativeNames = [];

        foreach ($data['nativeName'] ?? [] as $lang => $name) {
            $nativeNames[$lang] = NativeName::fromArray($name);
        }

        return new self(
            common: $data['common'] ?? '',
            official: $data['official'] ?? '',
            nativeName: $nativeNames,
        );
    }
}
