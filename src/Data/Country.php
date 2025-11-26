<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

use Illuminate\Support\Collection;

final readonly class Country
{
    /**
     * @param  string[]  $tld
     * @param  Collection<int, Currency>  $currencies
     * @param  string[]  $capital
     * @param  string[]  $altSpellings
     * @param  array<string, string>  $languages
     * @param  float[]  $latlng
     * @param  string[]  $borders
     * @param  Collection<int, Demonym>  $demonyms
     * @param  Collection<int, Translation>  $translations
     * @param  array<string, float>  $gini
     * @param  string[]  $timezones
     * @param  string[]  $continents
     */
    public function __construct(
        public CountryName $name,
        public array $tld,
        public string $cca2,
        public string $ccn3,
        public string $cca3,
        public ?string $cioc,
        public bool $independent,
        public string $status,
        public bool $unMember,
        public Collection $currencies,
        public Idd $idd,
        public array $capital,
        public array $altSpellings,
        public string $region,
        public ?string $subregion,
        public array $languages,
        public array $latlng,
        public bool $landlocked,
        public array $borders,
        public float $area,
        public Collection $demonyms,
        public Collection $translations,
        public string $flag,
        public Maps $maps,
        public int $population,
        public array $gini,
        public ?string $fifa,
        public Car $car,
        public array $timezones,
        public array $continents,
        public Flags $flags,
        public CoatOfArms $coatOfArms,
        public string $startOfWeek,
        public CapitalInfo $capitalInfo,
        public ?PostalCode $postalCode,
    ) {}

    public static function fromArray(array $data): self
    {
        $currencies = collect();
        foreach ($data['currencies'] ?? [] as $code => $currency) {
            $currencies->push(Currency::fromArray($code, $currency));
        }

        $demonyms = collect();
        foreach ($data['demonyms'] ?? [] as $lang => $demonym) {
            $demonyms->push(Demonym::fromArray($lang, $demonym));
        }

        $translations = collect();
        foreach ($data['translations'] ?? [] as $lang => $translation) {
            $translations->push(Translation::fromArray($lang, $translation));
        }

        return new self(
            name: CountryName::fromArray($data['name'] ?? []),
            tld: $data['tld'] ?? [],
            cca2: $data['cca2'] ?? '',
            ccn3: $data['ccn3'] ?? '',
            cca3: $data['cca3'] ?? '',
            cioc: $data['cioc'] ?? null,
            independent: $data['independent'] ?? false,
            status: $data['status'] ?? '',
            unMember: $data['unMember'] ?? false,
            currencies: $currencies,
            idd: Idd::fromArray($data['idd'] ?? []),
            capital: $data['capital'] ?? [],
            altSpellings: $data['altSpellings'] ?? [],
            region: $data['region'] ?? '',
            subregion: $data['subregion'] ?? null,
            languages: $data['languages'] ?? [],
            latlng: $data['latlng'] ?? [],
            landlocked: $data['landlocked'] ?? false,
            borders: $data['borders'] ?? [],
            area: (float) ($data['area'] ?? 0),
            demonyms: $demonyms,
            translations: $translations,
            flag: $data['flag'] ?? '',
            maps: Maps::fromArray($data['maps'] ?? []),
            population: (int) ($data['population'] ?? 0),
            gini: $data['gini'] ?? [],
            fifa: $data['fifa'] ?? null,
            car: Car::fromArray($data['car'] ?? []),
            timezones: $data['timezones'] ?? [],
            continents: $data['continents'] ?? [],
            flags: Flags::fromArray($data['flags'] ?? []),
            coatOfArms: CoatOfArms::fromArray($data['coatOfArms'] ?? []),
            startOfWeek: $data['startOfWeek'] ?? '',
            capitalInfo: CapitalInfo::fromArray($data['capitalInfo'] ?? []),
            postalCode: isset($data['postalCode']) ? PostalCode::fromArray($data['postalCode']) : null,
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
