<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries\Enums;

enum CountryField: string
{
    case Name = 'name';
    case Tld = 'tld';
    case Cca2 = 'cca2';
    case Ccn3 = 'ccn3';
    case Cioc = 'cioc';
    case Independent = 'independent';
    case Status = 'status';
    case UnMember = 'unMember';
    case Currencies = 'currencies';
    case Idd = 'idd';
    case Capital = 'capital';
    case AltSpellings = 'altSpellings';
    case Region = 'region';
    case Subregion = 'subregion';
    case Languages = 'languages';
    case Latlng = 'latlng';
    case Landlocked = 'landlocked';
    case Borders = 'borders';
    case Area = 'area';
    case Demonyms = 'demonyms';
    case Cca3 = 'cca3';
    case Translations = 'translations';
    case Flag = 'flag';
    case Maps = 'maps';
    case Population = 'population';
    case Gini = 'gini';
    case Fifa = 'fifa';
    case Car = 'car';
    case Timezones = 'timezones';
    case Continents = 'continents';
    case Flags = 'flags';
    case CoatOfArms = 'coatOfArms';
    case StartOfWeek = 'startOfWeek';
    case CapitalInfo = 'capitalInfo';
    case PostalCode = 'postalCode';
}
