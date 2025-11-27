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

// Iterating over results
foreach ($countries as $country) {
    echo $country->name->common;                  // Country name
    echo $country->capital->first()?->name;       // Capital city
    echo $country->languages->first()?->name;     // Primary language
}
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
- **Count:** 250 countries
