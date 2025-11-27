# Search by Subregion

Searches for countries by subregion.

> **Reference:** [RestCountries - Subregion](https://restcountries.com/#endpoints-subregion)

## Usage

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// Search by subregion
$countries = RestCountries::getBySubregion('western europe');

// With specific fields
$countries = RestCountries::getBySubregion('south america', [
    CountryField::Name,
    CountryField::Cca2,
    CountryField::Capital,
]);

// Iterating over results
foreach ($countries as $country) {
    echo $country->name->common;
    echo $country->capital->first()?->name;
}
```

## Request

```
GET https://restcountries.com/v3.1/subregion/western%20europe?fields=name,cca2
```

## Response

```json
[
  {
    "name": {
      "common": "Belgium",
      "official": "Kingdom of Belgium",
      "nativeName": {
        "deu": {
          "official": "Königreich Belgien",
          "common": "Belgien"
        },
        "fra": {
          "official": "Royaume de Belgique",
          "common": "Belgique"
        },
        "nld": {
          "official": "Koninkrijk België",
          "common": "België"
        }
      }
    },
    "cca2": "BE"
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
- **Count:** 8 countries in Western Europe, 14 in South America
