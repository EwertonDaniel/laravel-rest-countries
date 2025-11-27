# Search by Region

Searches for countries by region.

> **Reference:** [RestCountries - Region](https://restcountries.com/#endpoints-region)

## Usage

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// Search by region
$countries = RestCountries::getByRegion('europe');

// With specific fields
$countries = RestCountries::getByRegion('europe', [
    CountryField::Name,
    CountryField::Cca2,
    CountryField::Capital,
]);

// Available regions: Africa, Americas, Asia, Europe, Oceania

// Iterating over results
foreach ($countries as $country) {
    echo $country->name->common;
    echo $country->capital->first()?->name;
}
```

## Request

```
GET https://restcountries.com/v3.1/region/europe?fields=name,cca2
```

## Response

```json
[
  {
    "name": {
      "common": "Italy",
      "official": "Italian Republic",
      "nativeName": {
        "ita": {
          "official": "Repubblica italiana",
          "common": "Italia"
        }
      }
    },
    "cca2": "IT"
  },
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
    "cca2": "DE"
  }
]
```

## Return

- **Type:** `Collection<int, Country>|null`
- **Description:** Collection of `Country` objects or `null` on error
- **Count:** 53 countries in Europe
