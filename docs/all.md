# All Countries

Returns all countries.

> **Reference:** [RestCountries - All](https://restcountries.com/#endpoints-all)

## Usage

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// With default fields (name, cca2)
$countries = RestCountries::getAll();

// With specific fields
$countries = RestCountries::getAll([
    CountryField::Name,
    CountryField::Cca2,
    CountryField::Capital,
    CountryField::Population,
]);
```

## Request

```
GET https://restcountries.com/v3.1/all?fields=name,cca2
```

## Response

```json
[
  {
    "name": {
      "common": "Antigua and Barbuda",
      "official": "Antigua and Barbuda",
      "nativeName": {
        "eng": {
          "official": "Antigua and Barbuda",
          "common": "Antigua and Barbuda"
        }
      }
    },
    "cca2": "AG"
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
