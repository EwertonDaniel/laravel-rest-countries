# Search by Independent Status

Searches for countries by independence status.

> **Reference:** [RestCountries - Independent](https://restcountries.com/#endpoints-independent)

## Usage

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// Search for independent countries (default)
$countries = RestCountries::getIndependent();

// Search for non-independent countries
$countries = RestCountries::getIndependent(false);

// With specific fields
$countries = RestCountries::getIndependent(true, [
    CountryField::Name,
    CountryField::Cca2,
    CountryField::Independent,
]);
```

## Request

```
GET https://restcountries.com/v3.1/independent?status=true&fields=name,cca2
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
    "cca2": "DE"
  },
  {
    "name": {
      "common": "Brazil",
      "official": "Federative Republic of Brazil",
      "nativeName": {
        "por": {
          "official": "República Federativa do Brasil",
          "common": "Brasil"
        }
      }
    },
    "cca2": "BR"
  }
]
```

## Return

- **Type:** `Collection<int, Country>|null`
- **Description:** Collection of `Country` objects or `null` on error
