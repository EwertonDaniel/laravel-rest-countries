# Search by Full Name

Searches for a country by full name (exact match).

> **Reference:** [RestCountries - Full Name](https://restcountries.com/#endpoints-full-name)

## Usage

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// Exact full name search
$country = RestCountries::getByFullName('Federal Republic of Germany');

// With specific fields
$country = RestCountries::getByFullName('Federal Republic of Germany', [
    CountryField::Name,
    CountryField::Cca2,
    CountryField::Capital,
]);

// Accessing properties
echo $country->name->official;           // Federal Republic of Germany
echo $country->capital->first()->name;   // Berlin
```

## Request

```
GET https://restcountries.com/v3.1/name/germany?fullText=true&fields=name,cca2
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
  }
]
```

## Return

- **Type:** `Country|null`
- **Description:** `Country` object or `null` if not found
