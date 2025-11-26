# Search by Capital

Searches for countries by capital city.

> **Reference:** [RestCountries - Capital](https://restcountries.com/#endpoints-capital-city)

## Usage

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// Search by capital
$countries = RestCountries::getByCapital('berlin');

// With specific fields
$countries = RestCountries::getByCapital('berlin', [
    CountryField::Name,
    CountryField::Cca2,
    CountryField::Capital,
]);

// Accessing the first result
$country = $countries->first();
echo $country->capital[0]; // Berlin
```

## Request

```
GET https://restcountries.com/v3.1/capital/berlin?fields=name,cca2,capital
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
