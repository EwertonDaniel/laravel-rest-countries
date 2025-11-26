<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Facades;

use EwertonDaniel\RestCountries\Contracts\RestCountriesInterface;
use EwertonDaniel\RestCountries\Data\Country;
use EwertonDaniel\RestCountries\Enums\CountryField;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection<int, Country>|null getAll(CountryField[] $fields = [])
 * @method static Collection<int, Country>|null getIndependent(bool $status = true, CountryField[] $fields = [])
 * @method static Collection<int, Country>|null getByName(string $name, CountryField[] $fields = [])
 * @method static Country|null getByFullName(string $name, CountryField[] $fields = [])
 * @method static Country|null getByCode(string $code, CountryField[] $fields = [])
 * @method static Collection<int, Country>|null getByCodes(array $codes, CountryField[] $fields = [])
 * @method static Collection<int, Country>|null getByCurrency(string $currency, CountryField[] $fields = [])
 * @method static Collection<int, Country>|null getByDemonym(string $demonym, CountryField[] $fields = [])
 * @method static Collection<int, Country>|null getByLanguage(string $language, CountryField[] $fields = [])
 * @method static Collection<int, Country>|null getByCapital(string $capital, CountryField[] $fields = [])
 * @method static Collection<int, Country>|null getByCallingCode(string $code, CountryField[] $fields = [])
 * @method static Collection<int, Country>|null getByRegion(string $region, CountryField[] $fields = [])
 * @method static Collection<int, Country>|null getBySubregion(string $subregion, CountryField[] $fields = [])
 * @method static Collection<int, Country>|null getByTranslation(string $translation, CountryField[] $fields = [])
 *
 * @see \EwertonDaniel\RestCountries\RestCountries
 */
final class RestCountries extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return RestCountriesInterface::class;
    }
}
