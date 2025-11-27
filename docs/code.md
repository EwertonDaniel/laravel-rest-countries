# Search by Code

Searches for a country by ISO 3166-1 alpha-2 (`BR`) or alpha-3 (`BRA`) code.

> **Reference:** [RestCountries - Code](https://restcountries.com/#endpoints-code)

## Usage

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// Full search
$country = RestCountries::getByCode('DE');

// With specific fields
$country = RestCountries::getByCode('DE', [
    CountryField::Name,
    CountryField::Cca2,
    CountryField::Capital,
    CountryField::Currencies,
    CountryField::Population,
]);

// Accessing properties
echo $country->name->common;                      // Germany
echo $country->capital->first()->name;            // Berlin
echo $country->currencies->first()->symbol;       // €
echo $country->languages->first()->name;          // German
echo $country->coordinates->latitude;             // 51.0
echo $country->borders->pluck('countryCode')->toArray(); // ['AUT', 'BEL', 'CZE', ...]
```

## Request

```
GET https://restcountries.com/v3.1/alpha/DE?fields=name,cca2,capital,currencies,population
```

## Response

```json
[
  {
    "name": {
      "common": "Germany",
      "official": "Federal Republic of Germany",
      "nativeName": {
        "deu": {
          "official": "Bundesrepublik Deutschland",
          "common": "Deutschland"
        }
      }
    },
    "cca2": "DE",
    "currencies": {
      "EUR": {
        "name": "Euro",
        "symbol": "€"
      }
    },
    "capital": ["Berlin"],
    "population": 83491249
  }
]
```

## Return

- **Type:** `Country|null`
- **Description:** `Country` object or `null` if not found

## Country Properties

| Property | Type | Example |
|----------|------|---------|
| `name->common` | `string` | `Germany` |
| `name->official` | `string` | `Federal Republic of Germany` |
| `cca2` | `string` | `DE` |
| `cca3` | `string` | `DEU` |
| `capital` | `Collection<Capital>` | `Berlin` |
| `currencies` | `Collection<Currency>` | `EUR (€)` |
| `languages` | `Collection<Language>` | `deu: German` |
| `coordinates` | `Coordinates` | `51.0, 9.0` |
| `borders` | `Collection<Border>` | `AUT, BEL, CZE` |
| `population` | `int` | `83491249` |
