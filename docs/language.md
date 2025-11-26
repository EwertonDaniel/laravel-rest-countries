# Search by Language

Searches for countries by language.

> **Reference:** [RestCountries - Language](https://restcountries.com/#endpoints-language)

## Usage

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// Search by language
$countries = RestCountries::getByLanguage('portuguese');

// With specific fields
$countries = RestCountries::getByLanguage('portuguese', [
    CountryField::Name,
    CountryField::Cca2,
    CountryField::Languages,
]);

// Iterating over results
foreach ($countries as $country) {
    echo $country->name->common . "\n";
}
```

## Request

```
GET https://restcountries.com/v3.1/lang/portuguese?fields=name,cca2,languages
```

## Response

```json
[
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
    "cca2": "BR",
    "languages": {
      "por": "Portuguese"
    }
  },
  {
    "name": {
      "common": "Portugal",
      "official": "Portuguese Republic",
      "nativeName": {
        "por": {
          "official": "República Portuguesa",
          "common": "Portugal"
        }
      }
    },
    "cca2": "PT",
    "languages": {
      "por": "Portuguese"
    }
  },
  {
    "name": {
      "common": "Angola",
      "official": "Republic of Angola",
      "nativeName": {
        "por": {
          "official": "República de Angola",
          "common": "Angola"
        }
      }
    },
    "cca2": "AO",
    "languages": {
      "por": "Portuguese"
    }
  }
]
```

## Return

- **Type:** `Collection<int, Country>|null`
- **Description:** Collection of `Country` objects or `null` on error
