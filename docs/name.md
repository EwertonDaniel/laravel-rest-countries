# Search by Name

Searches for countries by name (partial match).

> **Reference:** [RestCountries - Name](https://restcountries.com/#endpoints-name)

## Usage

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// Partial name search
$countries = RestCountries::getByName('germany');

// With specific fields
$countries = RestCountries::getByName('germany', [
    CountryField::Name,
    CountryField::Cca2,
    CountryField::Capital,
]);

// May return multiple results
$countries = RestCountries::getByName('united'); // United States, United Kingdom, etc.
```

## Request

```
GET https://restcountries.com/v3.1/name/germany?fields=name,cca2,capital
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
    "capital": ["Berlin"]
  }
]
```

## Return

- **Type:** `Collection<int, Country>|null`
- **Description:** Collection of `Country` objects or `null` on error
