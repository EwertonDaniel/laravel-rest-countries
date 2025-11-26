<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Contracts;

use EwertonDaniel\RestCountries\Data\Country;
use EwertonDaniel\RestCountries\Enums\CountryField;
use Illuminate\Support\Collection;

interface RestCountriesInterface
{
    /**
     * @param  CountryField[]  $fields
     * @return Collection<int, Country>|null
     */
    public function getAll(array $fields = []): ?Collection;

    /**
     * @param  CountryField[]  $fields
     * @return Collection<int, Country>|null
     */
    public function getIndependent(bool $status = true, array $fields = []): ?Collection;

    /**
     * @param  CountryField[]  $fields
     * @return Collection<int, Country>|null
     */
    public function getByName(string $name, array $fields = []): ?Collection;

    /**
     * @param  CountryField[]  $fields
     */
    public function getByFullName(string $name, array $fields = []): ?Country;

    /**
     * @param  CountryField[]  $fields
     */
    public function getByCode(string $code, array $fields = []): ?Country;

    /**
     * @param  string[]  $codes
     * @param  CountryField[]  $fields
     * @return Collection<int, Country>|null
     */
    public function getByCodes(array $codes, array $fields = []): ?Collection;

    /**
     * @param  CountryField[]  $fields
     * @return Collection<int, Country>|null
     */
    public function getByCurrency(string $currency, array $fields = []): ?Collection;

    /**
     * @param  CountryField[]  $fields
     * @return Collection<int, Country>|null
     */
    public function getByDemonym(string $demonym, array $fields = []): ?Collection;

    /**
     * @param  CountryField[]  $fields
     * @return Collection<int, Country>|null
     */
    public function getByLanguage(string $language, array $fields = []): ?Collection;

    /**
     * @param  CountryField[]  $fields
     * @return Collection<int, Country>|null
     */
    public function getByCapital(string $capital, array $fields = []): ?Collection;

    /**
     * @param  CountryField[]  $fields
     * @return Collection<int, Country>|null
     */
    public function getByCallingCode(string $code, array $fields = []): ?Collection;

    /**
     * @param  CountryField[]  $fields
     * @return Collection<int, Country>|null
     */
    public function getByRegion(string $region, array $fields = []): ?Collection;

    /**
     * @param  CountryField[]  $fields
     * @return Collection<int, Country>|null
     */
    public function getBySubregion(string $subregion, array $fields = []): ?Collection;

    /**
     * @param  CountryField[]  $fields
     * @return Collection<int, Country>|null
     */
    public function getByTranslation(string $translation, array $fields = []): ?Collection;
}
