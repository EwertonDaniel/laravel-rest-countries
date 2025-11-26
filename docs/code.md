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
echo $country->name->common;                            // Germany
echo $country->capital[0];                              // Berlin
echo $country->currencies->firstWhere('code', 'EUR')->symbol; // €
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
