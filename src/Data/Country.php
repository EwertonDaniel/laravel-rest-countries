<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Data;

use Illuminate\Support\Collection;

final readonly class Country
{
    /**
     * @param  Collection<int, Tld>  $tld
     * @param  Collection<int, Currency>  $currencies
     * @param  Collection<int, Capital>  $capital
     * @param  Collection<int, AltSpelling>  $altSpellings
     * @param  Collection<int, Language>  $languages
     * @param  Collection<int, Border>  $borders
     * @param  Collection<int, Demonym>  $demonyms
     * @param  Collection<int, Translation>  $translations
     * @param  Collection<int, Gini>  $gini
     * @param  Collection<int, Timezone>  $timezones
     * @param  Collection<int, Continent>  $continents
     */
    public function __construct(
        public CountryName $name,
        public Collection $tld,
        public string $cca2,
        public string $ccn3,
        public string $cca3,
        public ?string $cioc,
        public bool $independent,
        public string $status,
        public bool $unMember,
        public Collection $currencies,
        public Idd $idd,
        public Collection $capital,
        public Collection $altSpellings,
        public string $region,
        public ?string $subregion,
        public Collection $languages,
        public Coordinates $coordinates,
        public bool $landlocked,
        public Collection $borders,
        public float $area,
        public Collection $demonyms,
        public Collection $translations,
        public string $flag,
        public Maps $maps,
        public int $population,
        public Collection $gini,
        public ?string $fifa,
        public Car $car,
        public Collection $timezones,
        public Collection $continents,
        public Flags $flags,
        public CoatOfArms $coatOfArms,
        public string $startOfWeek,
        public CapitalInfo $capitalInfo,
        public ?PostalCode $postalCode,
    ) {}

    public static function fromArray(array $data): self
    {
        $tld = collect($data['tld'] ?? [])->map(fn (string $domain) => Tld::fromString($domain));

        $currencies = collect();
        foreach ($data['currencies'] ?? [] as $code => $currency) {
            $currencies->push(Currency::fromArray($code, $currency));
        }

        $capital = collect($data['capital'] ?? [])->map(fn (string $name) => Capital::fromString($name));

        $altSpellings = collect($data['altSpellings'] ?? [])->map(fn (string $name) => AltSpelling::fromString($name));

        $languages = collect();
        foreach ($data['languages'] ?? [] as $code => $name) {
            $languages->push(Language::fromArray($code, $name));
        }

        $borders = collect($data['borders'] ?? [])->map(fn (string $code) => Border::fromString($code));

        $demonyms = collect();
        foreach ($data['demonyms'] ?? [] as $lang => $demonym) {
            $demonyms->push(Demonym::fromArray($lang, $demonym));
        }

        $translations = collect();
        foreach ($data['translations'] ?? [] as $lang => $translation) {
            $translations->push(Translation::fromArray($lang, $translation));
        }

        $gini = collect();
        foreach ($data['gini'] ?? [] as $year => $value) {
            $gini->push(Gini::fromArray((string) $year, (float) $value));
        }

        $timezones = collect($data['timezones'] ?? [])->map(fn (string $tz) => Timezone::fromString($tz));

        $continents = collect($data['continents'] ?? [])->map(fn (string $name) => Continent::fromString($name));

        return new self(
            name: CountryName::fromArray($data['name'] ?? []),
            tld: $tld,
            cca2: $data['cca2'] ?? '',
            ccn3: $data['ccn3'] ?? '',
            cca3: $data['cca3'] ?? '',
            cioc: $data['cioc'] ?? null,
            independent: $data['independent'] ?? false,
            status: $data['status'] ?? '',
            unMember: $data['unMember'] ?? false,
            currencies: $currencies,
            idd: Idd::fromArray($data['idd'] ?? []),
            capital: $capital,
            altSpellings: $altSpellings,
            region: $data['region'] ?? '',
            subregion: $data['subregion'] ?? null,
            languages: $languages,
            coordinates: Coordinates::fromArray($data['latlng'] ?? []),
            landlocked: $data['landlocked'] ?? false,
            borders: $borders,
            area: (float) ($data['area'] ?? 0),
            demonyms: $demonyms,
            translations: $translations,
            flag: $data['flag'] ?? '',
            maps: Maps::fromArray($data['maps'] ?? []),
            population: (int) ($data['population'] ?? 0),
            gini: $gini,
            fifa: $data['fifa'] ?? null,
            car: Car::fromArray($data['car'] ?? []),
            timezones: $timezones,
            continents: $continents,
            flags: Flags::fromArray($data['flags'] ?? []),
            coatOfArms: CoatOfArms::fromArray($data['coatOfArms'] ?? []),
            startOfWeek: $data['startOfWeek'] ?? '',
            capitalInfo: CapitalInfo::fromArray($data['capitalInfo'] ?? []),
            postalCode: isset($data['postalCode']) ? PostalCode::fromArray($data['postalCode']) : null,
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
