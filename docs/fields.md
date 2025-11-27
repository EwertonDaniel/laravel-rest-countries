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

| Enum | Value | Type | Description |
|------|-------|------|-------------|
| `Name` | `name` | `CountryName` | Country name |
| `Tld` | `tld` | `Collection<Tld>` | Top-level domain |
| `Cca2` | `cca2` | `string` | ISO 3166-1 alpha-2 code |
| `Ccn3` | `ccn3` | `string` | ISO 3166-1 numeric code |
| `Cca3` | `cca3` | `string` | ISO 3166-1 alpha-3 code |
| `Cioc` | `cioc` | `?string` | Olympic Committee code |
| `Independent` | `independent` | `bool` | Independence status |
| `Status` | `status` | `string` | Assignment status |
| `UnMember` | `unMember` | `bool` | UN member |
| `Currencies` | `currencies` | `Collection<Currency>` | Currencies |
| `Idd` | `idd` | `Idd` | International dialing code |
| `Capital` | `capital` | `Collection<Capital>` | Capital city |
| `AltSpellings` | `altSpellings` | `Collection<AltSpelling>` | Alternative spellings |
| `Region` | `region` | `string` | Region |
| `Subregion` | `subregion` | `?string` | Subregion |
| `Languages` | `languages` | `Collection<Language>` | Languages |
| `Latlng` | `latlng` | `Coordinates` | Latitude and longitude |
| `Landlocked` | `landlocked` | `bool` | Landlocked country |
| `Borders` | `borders` | `Collection<Border>` | Bordering countries |
| `Area` | `area` | `float` | Area in km² |
| `Demonyms` | `demonyms` | `Collection<Demonym>` | Demonyms |
| `Translations` | `translations` | `Collection<Translation>` | Translations |
| `Flag` | `flag` | `string` | Flag emoji |
| `Maps` | `maps` | `Maps` | Map links |
| `Population` | `population` | `int` | Population |
| `Gini` | `gini` | `Collection<Gini>` | Gini index |
| `Fifa` | `fifa` | `?string` | FIFA code |
| `Car` | `car` | `Car` | Traffic information |
| `Timezones` | `timezones` | `Collection<Timezone>` | Timezones |
| `Continents` | `continents` | `Collection<Continent>` | Continents |
| `Flags` | `flags` | `Flags` | Flag URLs |
| `CoatOfArms` | `coatOfArms` | `CoatOfArms` | Coat of arms |
| `StartOfWeek` | `startOfWeek` | `string` | Start of week |
| `CapitalInfo` | `capitalInfo` | `CapitalInfo` | Capital information |
| `PostalCode` | `postalCode` | `?PostalCode` | Postal code format |

## Data Transfer Objects (DTOs)

All data is returned as strongly-typed DTOs:

| DTO | Properties | Access Example |
|-----|------------|----------------|
| `Tld` | `domain` | `$country->tld->first()->domain` |
| `Capital` | `name` | `$country->capital->first()->name` |
| `Language` | `code`, `name` | `$country->languages->first()->name` |
| `Border` | `countryCode` | `$country->borders->first()->countryCode` |
| `Currency` | `code`, `name`, `symbol` | `$country->currencies->first()->symbol` |
| `Coordinates` | `latitude`, `longitude` | `$country->coordinates->latitude` |
| `Timezone` | `value` | `$country->timezones->first()->value` |
| `Continent` | `name` | `$country->continents->first()->name` |
| `Gini` | `year`, `value` | `$country->gini->first()->value` |
| `AltSpelling` | `name` | `$country->altSpellings->first()->name` |
| `Demonym` | `language`, `male`, `female` | `$country->demonyms->first()->male` |
| `Translation` | `language`, `official`, `common` | `$country->translations->first()->common` |

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

## Example Usage

```php
$country = RestCountries::getByCode('BR');

// Collections - use Collection methods
$country->capital->first()->name;                    // Brasília
$country->capital->pluck('name')->toArray();         // ['Brasília']

$country->languages->first()->name;                  // Portuguese
$country->languages->pluck('name')->implode(', ');   // Portuguese

$country->borders->pluck('countryCode')->toArray();  // ['ARG', 'BOL', ...]
$country->borders->count();                          // 10

$country->timezones->pluck('value')->toArray();      // ['UTC-05:00', 'UTC-04:00', ...]

$country->currencies->firstWhere('code', 'BRL')->symbol; // R$

// Direct objects
$country->coordinates->latitude;                     // -10.0
$country->coordinates->longitude;                    // -55.0

$country->idd->getFullCode();                        // +55

$country->flags->svg;                                // https://flagcdn.com/br.svg

$country->capitalInfo->getLatitude();                // -15.79
```
