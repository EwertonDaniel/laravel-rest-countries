# Filter Response (Fields)

Filters the fields returned in the API response.

> **Reference:** [RestCountries - Filter Response](https://restcountries.com/#filter-response)

## Usage

```php
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\Enums\CountryField;

// All methods support field filtering
$countries = RestCountries::getAll([
    CountryField::Name,
    CountryField::Cca2,
    CountryField::Capital,
    CountryField::Population,
    CountryField::Currencies,
]);

$country = RestCountries::getByCode('DE', [
    CountryField::Name,
    CountryField::Flags,
]);
```

## Available Fields (`CountryField`)

| Enum | Value | Description |
|------|-------|-------------|
| `Name` | `name` | Country name |
| `Tld` | `tld` | Top-level domain |
| `Cca2` | `cca2` | ISO 3166-1 alpha-2 code |
| `Ccn3` | `ccn3` | ISO 3166-1 numeric code |
| `Cca3` | `cca3` | ISO 3166-1 alpha-3 code |
| `Cioc` | `cioc` | Olympic Committee code |
| `Independent` | `independent` | Independence status |
| `Status` | `status` | Assignment status |
| `UnMember` | `unMember` | UN member |
| `Currencies` | `currencies` | Currencies |
| `Idd` | `idd` | International dialing code |
| `Capital` | `capital` | Capital city |
| `AltSpellings` | `altSpellings` | Alternative spellings |
| `Region` | `region` | Region |
| `Subregion` | `subregion` | Subregion |
| `Languages` | `languages` | Languages |
| `Latlng` | `latlng` | Latitude and longitude |
| `Landlocked` | `landlocked` | Landlocked country |
| `Borders` | `borders` | Bordering countries |
| `Area` | `area` | Area in km² |
| `Demonyms` | `demonyms` | Demonyms |
| `Translations` | `translations` | Translations |
| `Flag` | `flag` | Flag emoji |
| `Maps` | `maps` | Map links |
| `Population` | `population` | Population |
| `Gini` | `gini` | Gini index |
| `Fifa` | `fifa` | FIFA code |
| `Car` | `car` | Traffic information |
| `Timezones` | `timezones` | Timezones |
| `Continents` | `continents` | Continents |
| `Flags` | `flags` | Flag URLs |
| `CoatOfArms` | `coatOfArms` | Coat of arms |
| `StartOfWeek` | `startOfWeek` | Start of week |
| `CapitalInfo` | `capitalInfo` | Capital information |
| `PostalCode` | `postalCode` | Postal code format |

## Example Request

```
GET https://restcountries.com/v3.1/alpha/DE?fields=name,cca2,capital,currencies,population
```

## Response

```json
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
  },
  "capital": ["Berlin"],
  "population": 83491249
}
```
