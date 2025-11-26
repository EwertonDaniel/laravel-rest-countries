# Search by Currency

Searches for countries by currency.

> **Reference:** [RestCountries - Currency](https://restcountries.com/#endpoints-currency)

## Usage

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// Search by currency code
$countries = RestCountries::getByCurrency('EUR');

// With specific fields
$countries = RestCountries::getByCurrency('EUR', [
    CountryField::Name,
    CountryField::Cca2,
    CountryField::Currencies,
]);

// Iterating over results
foreach ($countries as $country) {
    echo $country->name->common . "\n";
}
```

## Request

```
GET https://restcountries.com/v3.1/currency/EUR?fields=name,cca2,currencies
```

## Response

```json
[
  {
    "name": {
      "common": "Spain",
      "official": "Kingdom of Spain",
      "nativeName": {
        "spa": {
          "official": "Reino de España",
          "common": "España"
        }
      }
    },
    "cca2": "ES",
    "currencies": {
      "EUR": {
        "name": "Euro",
        "symbol": "€"
      }
    }
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
    "cca2": "DE",
    "currencies": {
      "EUR": {
        "name": "Euro",
        "symbol": "€"
      }
    }
  }
]
```

## Return

- **Type:** `Collection<int, Country>|null`
- **Description:** Collection of `Country` objects or `null` on error
