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
echo $country->capital->first()->name; // Berlin
echo $country->capital->pluck('name')->toArray(); // ['Berlin']
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

## Capital DTO

The `capital` property is a `Collection<Capital>` where each `Capital` has:

| Property | Type | Description |
|----------|------|-------------|
| `name` | `string` | Capital city name |

```php
// Example usage
$country->capital->first()->name;                    // Berlin
$country->capital->pluck('name')->implode(', ');     // Berlin
(string) $country->capital->first();                 // Berlin (via __toString)
```
