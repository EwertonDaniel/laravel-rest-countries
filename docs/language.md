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
    echo $country->name->common;
    echo $country->languages->first()->name; // Portuguese
}

// Finding a specific language
$portuguese = $country->languages->firstWhere('code', 'por');
echo $portuguese->name; // Portuguese
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
  }
]
```

## Return

- **Type:** `Collection<int, Country>|null`
- **Description:** Collection of `Country` objects or `null` on error
- **Count:** 10 countries speak Portuguese

## Language DTO

The `languages` property is a `Collection<Language>` where each `Language` has:

| Property | Type | Description |
|----------|------|-------------|
| `code` | `string` | ISO 639-3 language code (e.g., `por`, `deu`) |
| `name` | `string` | Language name (e.g., `Portuguese`, `German`) |

```php
// Example usage
$country->languages->first()->code;                  // por
$country->languages->first()->name;                  // Portuguese
$country->languages->pluck('name')->toArray();       // ['Portuguese']
$country->languages->firstWhere('code', 'por')->name; // Portuguese
```
