<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

final readonly class Timezone
{
    public function __construct(
        public string $value,
    ) {}

    public static function fromString(string $value): self
    {
        return new self(value: $value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
