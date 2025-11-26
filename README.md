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
echo $country->name->common; // Brazil
echo $country->capital[0];   // Brasilia

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

```php
$country = RestCountries::getByCode('DE');

// Main properties
$country->name->common;           // Germany
$country->name->official;         // Federal Republic of Germany
$country->cca2;                   // DE
$country->cca3;                   // DEU
$country->capital;                // ['Berlin']
$country->region;                 // Europe
$country->subregion;              // Western Europe
$country->population;             // 83491249
$country->area;                   // 357114.0
$country->languages;              // ['deu' => 'German']
$country->borders;                // ['AUT', 'BEL', 'CZE', ...]

// Currencies (Collection)
$country->currencies->firstWhere('code', 'EUR')->name;   // Euro
$country->currencies->firstWhere('code', 'EUR')->symbol; // €

// Calling code
$country->idd->root;              // +4
$country->idd->getFullCode();     // +49

// Flag
$country->flag;                   // 🇩🇪
$country->flags->png;             // https://flagcdn.com/w320/de.png
$country->flags->svg;             // https://flagcdn.com/de.svg

// Coordinates
$country->latlng;                 // [51, 9]
$country->getLatitude();          // 51.0
$country->getLongitude();         // 9.0

// Maps
$country->maps->googleMaps;       // https://goo.gl/maps/...
$country->maps->openStreetMaps;   // https://www.openstreetmap.org/...

// Demonyms (Collection)
$country->demonyms->firstWhere('language', 'eng')->male;   // German
$country->demonyms->firstWhere('language', 'eng')->female; // German

// Translations (Collection)
$country->translations->firstWhere('language', 'por')->common; // Alemanha
```

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
