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
    echo $country->name->common;
    echo $country->currencies->first()->symbol; // €
}

// Finding a specific currency
$euro = $country->currencies->firstWhere('code', 'EUR');
echo $euro->name;   // Euro
echo $euro->symbol; // €
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
- **Count:** 36 countries use Euro

## Currency DTO

The `currencies` property is a `Collection<Currency>` where each `Currency` has:

| Property | Type | Description |
|----------|------|-------------|
| `code` | `string` | Currency code (e.g., `EUR`, `USD`, `BRL`) |
| `name` | `string` | Currency name (e.g., `Euro`, `United States dollar`) |
| `symbol` | `string` | Currency symbol (e.g., `€`, `$`, `R$`) |

```php
// Example usage
$country->currencies->first()->code;                 // EUR
$country->currencies->first()->name;                 // Euro
$country->currencies->first()->symbol;               // €
$country->currencies->firstWhere('code', 'EUR')->symbol; // €
```
