# Search by List of Codes

Searches for multiple countries by a list of ISO 3166-1 codes.

> **Reference:** [RestCountries - List of Codes](https://restcountries.com/#endpoints-list-of-codes)

## Usage

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// Search by multiple codes
$countries = RestCountries::getByCodes(['DE', 'FR', 'BR']);

// With specific fields
$countries = RestCountries::getByCodes(['DE', 'FR', 'BR'], [
    CountryField::Name,
    CountryField::Cca2,
]);

// Iterating over results
foreach ($countries as $country) {
    echo $country->name->common . "\n";
}
```

## Request

```
GET https://restcountries.com/v3.1/alpha?codes=DE,FR,BR&fields=name,cca2
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
      "common": "France",
      "official": "French Republic",
      "nativeName": {
        "fra": {
          "official": "République française",
          "common": "France"
        }
      }
    },
    "cca2": "FR"
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
