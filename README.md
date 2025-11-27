# Laravel REST Countries

A Laravel package to consume the [REST Countries](https://restcountries.com/) API.

## Requirements

- PHP 8.2+
- Laravel 10, 11 or 12

## Installation

```bash
composer require ewertondaniel/laravel-rest-countries
```

The service provider will be automatically registered.

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=rest-countries-config
```

Available environment variables:

```env
REST_COUNTRIES_URL=https://restcountries.com/v3.1
REST_COUNTRIES_LOG_CHANNEL=stack
REST_COUNTRIES_HTTP_VERIFY=false
REST_COUNTRIES_HTTP_TIMEOUT=30
```

## Usage

### Via Facade

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// Get all countries (default fields: name, cca2)
$countries = RestCountries::getAll();

// With specific fields
$countries = RestCountries::getAll([
    CountryField::Name,
    CountryField::Capital,
    CountryField::Population,
]);

// Get by code
$country = RestCountries::getByCode('BR');
echo $country->name->common;          // Brazil
echo $country->capital->first()->name; // Brasília

// Get by name
$countries = RestCountries::getByName('brazil');

// Get by region
$countries = RestCountries::getByRegion('americas');
```

### Via Dependency Injection

```php
use EwertonDaniel\RestCountries\Contracts\RestCountriesInterface;

class CountryController
{
    public function __construct(
        private RestCountriesInterface $restCountries
    ) {}

    public function index()
    {
        return $this->restCountries->getAll();
    }
}
```

## Available Methods

| Method | Return | Description |
|--------|--------|-------------|
| `getAll($fields)` | `Collection<Country>` | Get all countries |
| `getIndependent($status, $fields)` | `Collection<Country>` | Get independent countries |
| `getByName($name, $fields)` | `Collection<Country>` | Search by name |
| `getByFullName($name, $fields)` | `Country` | Search by full name |
| `getByCode($code, $fields)` | `Country` | Search by code |
| `getByCodes($codes, $fields)` | `Collection<Country>` | Search by list of codes |
| `getByCurrency($currency, $fields)` | `Collection<Country>` | Search by currency |
| `getByDemonym($demonym, $fields)` | `Collection<Country>` | Search by demonym |
| `getByLanguage($language, $fields)` | `Collection<Country>` | Search by language |
| `getByCapital($capital, $fields)` | `Collection<Country>` | Search by capital |
| `getByCallingCode($code, $fields)` | `Collection<Country>` | Search by calling code |
| `getByRegion($region, $fields)` | `Collection<Country>` | Search by region |
| `getBySubregion($subregion, $fields)` | `Collection<Country>` | Search by subregion |
| `getByTranslation($translation, $fields)` | `Collection<Country>` | Search by translation |

## Country Object

All properties that were previously arrays are now typed Collections of DTOs for better type safety and autocompletion.

```php
$country = RestCountries::getByCode('DE');

// Name
$country->name->common;                    // Germany
$country->name->official;                  // Federal Republic of Germany
$country->name->nativeName['deu']->common; // Deutschland

// Codes
$country->cca2;                            // DE
$country->cca3;                            // DEU
$country->ccn3;                            // 276
$country->cioc;                            // GER

// Region
$country->region;                          // Europe
$country->subregion;                       // Western Europe

// Population & Area
$country->population;                      // 83491249
$country->area;                            // 357114.0

// TLD (Collection<Tld>)
$country->tld->first()->domain;            // .de
$country->tld->pluck('domain')->toArray(); // ['.de']

// Capital (Collection<Capital>)
$country->capital->first()->name;          // Berlin
$country->capital->pluck('name')->toArray(); // ['Berlin']

// Languages (Collection<Language>)
$country->languages->first()->code;        // deu
$country->languages->first()->name;        // German

// Borders (Collection<Border>)
$country->borders->first()->countryCode;   // AUT
$country->borders->pluck('countryCode')->toArray(); // ['AUT', 'BEL', 'CZE', ...]

// Currencies (Collection<Currency>)
$country->currencies->first()->code;       // EUR
$country->currencies->first()->name;       // Euro
$country->currencies->first()->symbol;     // €

// Calling code (Idd)
$country->idd->root;                       // +4
$country->idd->suffixes;                   // ['9']
$country->idd->getFullCode();              // +49

// Coordinates (Coordinates)
$country->coordinates->latitude;           // 51.0
$country->coordinates->longitude;          // 9.0
$country->getLatitude();                   // 51.0
$country->getLongitude();                  // 9.0

// Timezones (Collection<Timezone>)
$country->timezones->first()->value;       // UTC+01:00
$country->timezones->pluck('value')->toArray(); // ['UTC+01:00']

// Continents (Collection<Continent>)
$country->continents->first()->name;       // Europe

// Gini Index (Collection<Gini>)
$country->gini->first()->year;             // 2016
$country->gini->first()->value;            // 31.9

// AltSpellings (Collection<AltSpelling>)
$country->altSpellings->first()->name;     // DE

// Flag
$country->flag;                            // 🇩🇪
$country->flags->png;                      // https://flagcdn.com/w320/de.png
$country->flags->svg;                      // https://flagcdn.com/de.svg
$country->flags->alt;                      // The flag of Germany

// Coat of Arms
$country->coatOfArms->png;                 // https://mainfacts.com/media/images/coats_of_arms/de.png
$country->coatOfArms->svg;                 // https://mainfacts.com/media/images/coats_of_arms/de.svg

// Maps
$country->maps->googleMaps;                // https://goo.gl/maps/...
$country->maps->openStreetMaps;            // https://www.openstreetmap.org/...

// Capital Info (CapitalInfo with Coordinates)
$country->capitalInfo->coordinates->latitude;  // 52.52
$country->capitalInfo->coordinates->longitude; // 13.4
$country->capitalInfo->getLatitude();          // 52.52
$country->capitalInfo->getLongitude();         // 13.4

// Demonyms (Collection<Demonym>)
$country->demonyms->firstWhere('language', 'eng')->male;   // German
$country->demonyms->firstWhere('language', 'eng')->female; // German

// Translations (Collection<Translation>)
$country->translations->firstWhere('language', 'por')->common;   // Alemanha
$country->translations->firstWhere('language', 'por')->official; // República Federal da Alemanha

// Car
$country->car->signs;                      // ['DY']
$country->car->side;                       // right

// Postal Code
$country->postalCode?->format;             // #####
$country->postalCode?->regex;              // ^(\d{5})$

// Other
$country->independent;                     // true
$country->unMember;                        // true
$country->status;                          // officially-assigned
$country->landlocked;                      // false
$country->startOfWeek;                     // monday
$country->fifa;                            // GER
```

## Data Transfer Objects (DTOs)

All data is returned as strongly-typed DTOs:

| DTO | Properties | Description |
|-----|------------|-------------|
| `Country` | All properties | Main country object |
| `CountryName` | `common`, `official`, `nativeName` | Country name |
| `NativeName` | `official`, `common` | Native name |
| `Tld` | `domain` | Top-level domain |
| `Capital` | `name` | Capital city |
| `Language` | `code`, `name` | Language |
| `Border` | `countryCode` | Border country code |
| `Currency` | `code`, `name`, `symbol` | Currency |
| `Idd` | `root`, `suffixes` | International dialing code |
| `Coordinates` | `latitude`, `longitude` | Geographic coordinates |
| `Timezone` | `value` | Timezone |
| `Continent` | `name` | Continent |
| `Gini` | `year`, `value` | Gini index |
| `AltSpelling` | `name` | Alternative spelling |
| `Demonym` | `language`, `male`, `female` | Demonym |
| `Translation` | `language`, `official`, `common` | Translation |
| `Flags` | `png`, `svg`, `alt` | Flag URLs |
| `CoatOfArms` | `png`, `svg` | Coat of arms URLs |
| `Maps` | `googleMaps`, `openStreetMaps` | Map URLs |
| `Car` | `signs`, `side` | Car/traffic info |
| `CapitalInfo` | `coordinates` | Capital coordinates |
| `PostalCode` | `format`, `regex` | Postal code format |

## Documentation by Endpoint

- [All Countries](docs/all.md)
- [Search by Code](docs/code.md)
- [Search by List of Codes](docs/codes.md)
- [Search by Name](docs/name.md)
- [Search by Full Name](docs/full-name.md)
- [Search by Currency](docs/currency.md)
- [Search by Language](docs/language.md)
- [Search by Capital](docs/capital.md)
- [Search by Region](docs/region.md)
- [Search by Subregion](docs/subregion.md)
- [Search by Demonym](docs/demonym.md)
- [Search by Translation](docs/translation.md)
- [Search by Independent](docs/independent.md)
- [Filter Response (Fields)](docs/fields.md)

## Testing

```bash
composer test
```

## License

MIT
