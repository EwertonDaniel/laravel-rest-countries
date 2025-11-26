# Search by Translation

Searches for countries by name translation.

> **Reference:** [RestCountries - Translation](https://restcountries.com/#endpoints-translation)

## Usage

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// Search by translation
$countries = RestCountries::getByTranslation('alemanha');

// With specific fields
$countries = RestCountries::getByTranslation('brasil', [
    CountryField::Name,
    CountryField::Cca2,
]);

// Search in any language
$countries = RestCountries::getByTranslation('deutschland'); // German
$countries = RestCountries::getByTranslation('allemagne');   // French
```

## Request

```
GET https://restcountries.com/v3.1/translation/alemanha?fields=name,cca2
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

- **Type:** `Collection<int, Country>|null`
- **Description:** Collection of `Country` objects or `null` on error
