# Search by Demonym

Searches for countries by demonym.

> **Reference:** [RestCountries - Demonym](https://restcountries.com/#endpoints-demonym)

## Usage

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// Search by demonym
$countries = RestCountries::getByDemonym('german');

// With specific fields
$countries = RestCountries::getByDemonym('brazilian', [
    CountryField::Name,
    CountryField::Cca2,
    CountryField::Demonyms,
]);

// Accessing demonyms
$country = $countries->first();
echo $country->demonyms->firstWhere('language', 'eng')->male;   // German
echo $country->demonyms->firstWhere('language', 'eng')->female; // German
```

## Request

```
GET https://restcountries.com/v3.1/demonym/german?fields=name,cca2,demonyms
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
    "demonyms": {
      "eng": {
        "f": "German",
        "m": "German"
      },
      "fra": {
        "f": "Allemande",
        "m": "Allemand"
      }
    }
  }
]
```

## Return

- **Type:** `Collection<int, Country>|null`
- **Description:** Collection of `Country` objects or `null` on error

## Demonym DTO

The `demonyms` property is a `Collection<Demonym>` where each `Demonym` has:

| Property | Type | Description |
|----------|------|-------------|
| `language` | `string` | Language code (e.g., `eng`, `fra`) |
| `male` | `string` | Male demonym |
| `female` | `string` | Female demonym |

```php
// Example usage
$country->demonyms->firstWhere('language', 'eng')->male;   // German
$country->demonyms->firstWhere('language', 'eng')->female; // German
$country->demonyms->firstWhere('language', 'fra')->male;   // Allemand
```
