<?php

declare(strict_types=1);

use EwertonDaniel\RestCountries\Contracts\RestCountriesInterface;
use EwertonDaniel\RestCountries\Data\Country;
use EwertonDaniel\RestCountries\Enums\CountryField;
use EwertonDaniel\RestCountries\Facades\RestCountries;
use EwertonDaniel\RestCountries\RestCountries as RestCountriesClass;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;

function createMockedClient(array $responses): Client
{
    $mock = new MockHandler($responses);
    $handlerStack = HandlerStack::create($mock);

    return new Client(['handler' => $handlerStack]);
}

function germanyResponse(): array
{
    return [[
        'name' => [
            'common' => 'Germany',
            'official' => 'Federal Republic of Germany',
            'nativeName' => [
                'deu' => ['official' => 'Bundesrepublik Deutschland', 'common' => 'Deutschland'],
            ],
        ],
        'tld' => ['.de'],
        'cca2' => 'DE',
        'ccn3' => '276',
        'cca3' => 'DEU',
        'cioc' => 'GER',
        'independent' => true,
        'status' => 'officially-assigned',
        'unMember' => true,
        'currencies' => ['EUR' => ['symbol' => '€', 'name' => 'Euro']],
        'idd' => ['root' => '+4', 'suffixes' => ['9']],
        'capital' => ['Berlin'],
        'altSpellings' => ['DE', 'Federal Republic of Germany'],
        'region' => 'Europe',
        'subregion' => 'Western Europe',
        'languages' => ['deu' => 'German'],
        'latlng' => [51, 9],
        'landlocked' => false,
        'borders' => ['AUT', 'BEL', 'CZE'],
        'area' => 357114,
        'demonyms' => ['eng' => ['f' => 'German', 'm' => 'German']],
        'translations' => ['por' => ['official' => 'República Federal da Alemanha', 'common' => 'Alemanha']],
        'flag' => '🇩🇪',
        'maps' => ['googleMaps' => 'https://goo.gl/maps/test', 'openStreetMaps' => 'https://osm.org/test'],
        'population' => 83491249,
        'gini' => ['2016' => 31.9],
        'fifa' => 'GER',
        'car' => ['signs' => ['DY'], 'side' => 'right'],
        'timezones' => ['UTC+01:00'],
        'continents' => ['Europe'],
        'flags' => ['png' => 'https://flagcdn.com/w320/de.png', 'svg' => 'https://flagcdn.com/de.svg', 'alt' => 'The flag of Germany'],
        'coatOfArms' => ['png' => 'https://mainfacts.com/media/images/coats_of_arms/de.png', 'svg' => 'https://mainfacts.com/media/images/coats_of_arms/de.svg'],
        'startOfWeek' => 'monday',
        'capitalInfo' => ['latlng' => [52.52, 13.4]],
        'postalCode' => ['format' => '#####', 'regex' => '^(\\d{5})$'],
    ]];
}

function multipleCountriesResponse(): array
{
    return [
        ['name' => ['common' => 'Germany', 'official' => 'Federal Republic of Germany'], 'cca2' => 'DE'],
        ['name' => ['common' => 'France', 'official' => 'French Republic'], 'cca2' => 'FR'],
    ];
}

// Container & Facade
test('resolves from container', function () {
    expect(app(RestCountriesInterface::class))->toBeInstanceOf(RestCountriesClass::class);
});

test('facade resolves correctly', function () {
    expect(RestCountries::getFacadeRoot())->toBeInstanceOf(RestCountriesClass::class);
});

// getAll
test('gets all countries with default fields (name, cca2)', function () {
    $client = createMockedClient([new Response(200, [], json_encode(multipleCountriesResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getAll();

    expect($result)->toBeInstanceOf(Collection::class);
    expect($result)->toHaveCount(2);
    expect($result->first())->toBeInstanceOf(Country::class);
    expect($result->first()->name->common)->toBe('Germany');
});

test('gets all countries with custom fields', function () {
    $client = createMockedClient([new Response(200, [], json_encode(germanyResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getAll([CountryField::Name, CountryField::Capital, CountryField::Currencies]);

    expect($result)->toBeInstanceOf(Collection::class);
});

// getIndependent
test('gets independent countries', function () {
    $client = createMockedClient([new Response(200, [], json_encode(multipleCountriesResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getIndependent();

    expect($result)->toBeInstanceOf(Collection::class);
    expect($result)->toHaveCount(2);
});

test('gets non-independent countries', function () {
    $client = createMockedClient([new Response(200, [], json_encode([['name' => ['common' => 'Puerto Rico'], 'cca2' => 'PR']]))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getIndependent(false);

    expect($result)->toBeInstanceOf(Collection::class);
});

// getByName
test('gets country by name', function () {
    $client = createMockedClient([new Response(200, [], json_encode(germanyResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getByName('Germany');

    expect($result)->toBeInstanceOf(Collection::class);
    expect($result->first()->name->common)->toBe('Germany');
});

test('returns null for empty name', function () {
    $restCountries = new RestCountriesClass();

    expect($restCountries->getByName(''))->toBeNull();
});

// getByFullName
test('gets country by full name', function () {
    $client = createMockedClient([new Response(200, [], json_encode(germanyResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getByFullName('Federal Republic of Germany');

    expect($result)->toBeInstanceOf(Country::class);
    expect($result->name->official)->toBe('Federal Republic of Germany');
});

test('returns null for empty full name', function () {
    $restCountries = new RestCountriesClass();

    expect($restCountries->getByFullName(''))->toBeNull();
});

// getByCode
test('gets country by code', function () {
    $client = createMockedClient([new Response(200, [], json_encode(germanyResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getByCode('DE');

    expect($result)->toBeInstanceOf(Country::class);
    expect($result->cca2)->toBe('DE');
    expect($result->cca3)->toBe('DEU');
});

test('returns null for empty code', function () {
    $restCountries = new RestCountriesClass();

    expect($restCountries->getByCode(''))->toBeNull();
});

// getByCodes
test('gets countries by codes', function () {
    $client = createMockedClient([new Response(200, [], json_encode(multipleCountriesResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getByCodes(['DE', 'FR']);

    expect($result)->toBeInstanceOf(Collection::class);
    expect($result)->toHaveCount(2);
});

test('returns null for empty codes array', function () {
    $restCountries = new RestCountriesClass();

    expect($restCountries->getByCodes([]))->toBeNull();
});

// getByCurrency
test('gets countries by currency', function () {
    $client = createMockedClient([new Response(200, [], json_encode(germanyResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getByCurrency('EUR');

    expect($result)->toBeInstanceOf(Collection::class);
});

test('returns null for empty currency', function () {
    $restCountries = new RestCountriesClass();

    expect($restCountries->getByCurrency(''))->toBeNull();
});

// getByDemonym
test('gets countries by demonym', function () {
    $client = createMockedClient([new Response(200, [], json_encode(germanyResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getByDemonym('German');

    expect($result)->toBeInstanceOf(Collection::class);
});

test('returns null for empty demonym', function () {
    $restCountries = new RestCountriesClass();

    expect($restCountries->getByDemonym(''))->toBeNull();
});

// getByLanguage
test('gets countries by language', function () {
    $client = createMockedClient([new Response(200, [], json_encode(germanyResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getByLanguage('german');

    expect($result)->toBeInstanceOf(Collection::class);
});

test('returns null for empty language', function () {
    $restCountries = new RestCountriesClass();

    expect($restCountries->getByLanguage(''))->toBeNull();
});

// getByCapital
test('gets countries by capital', function () {
    $client = createMockedClient([new Response(200, [], json_encode(germanyResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getByCapital('Berlin');

    expect($result)->toBeInstanceOf(Collection::class);
});

test('returns null for empty capital', function () {
    $restCountries = new RestCountriesClass();

    expect($restCountries->getByCapital(''))->toBeNull();
});

// getByCallingCode
test('gets countries by calling code', function () {
    $client = createMockedClient([new Response(200, [], json_encode(germanyResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getByCallingCode('49');

    expect($result)->toBeInstanceOf(Collection::class);
});

test('returns null for empty calling code', function () {
    $restCountries = new RestCountriesClass();

    expect($restCountries->getByCallingCode(''))->toBeNull();
});

// getByRegion
test('gets countries by region', function () {
    $client = createMockedClient([new Response(200, [], json_encode(multipleCountriesResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getByRegion('Europe');

    expect($result)->toBeInstanceOf(Collection::class);
});

test('returns null for empty region', function () {
    $restCountries = new RestCountriesClass();

    expect($restCountries->getByRegion(''))->toBeNull();
});

// getBySubregion
test('gets countries by subregion', function () {
    $client = createMockedClient([new Response(200, [], json_encode(multipleCountriesResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getBySubregion('Western Europe');

    expect($result)->toBeInstanceOf(Collection::class);
});

test('returns null for empty subregion', function () {
    $restCountries = new RestCountriesClass();

    expect($restCountries->getBySubregion(''))->toBeNull();
});

// getByTranslation
test('gets countries by translation', function () {
    $client = createMockedClient([new Response(200, [], json_encode(germanyResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $result = $restCountries->getByTranslation('Alemanha');

    expect($result)->toBeInstanceOf(Collection::class);
});

test('returns null for empty translation', function () {
    $restCountries = new RestCountriesClass();

    expect($restCountries->getByTranslation(''))->toBeNull();
});

// Country DTO
test('country dto has all properties', function () {
    $client = createMockedClient([new Response(200, [], json_encode(germanyResponse()))]);
    $restCountries = new RestCountriesClass($client);

    $country = $restCountries->getByCode('DE');

    expect($country)->toBeInstanceOf(Country::class);
    expect($country->name->common)->toBe('Germany');
    expect($country->name->official)->toBe('Federal Republic of Germany');
    expect($country->name->nativeName)->toHaveKey('deu');
    expect($country->tld)->toBe(['.de']);
    expect($country->cca2)->toBe('DE');
    expect($country->ccn3)->toBe('276');
    expect($country->cca3)->toBe('DEU');
    expect($country->cioc)->toBe('GER');
    expect($country->independent)->toBeTrue();
    expect($country->status)->toBe('officially-assigned');
    expect($country->unMember)->toBeTrue();
    expect($country->currencies)->toBeInstanceOf(Collection::class);
    expect($country->currencies->firstWhere('code', 'EUR')->symbol)->toBe('€');
    expect($country->idd->root)->toBe('+4');
    expect($country->idd->getFullCode())->toBe('+49');
    expect($country->capital)->toBe(['Berlin']);
    expect($country->region)->toBe('Europe');
    expect($country->subregion)->toBe('Western Europe');
    expect($country->languages)->toBe(['deu' => 'German']);
    expect($country->latlng)->toBe([51, 9]);
    expect($country->getLatitude())->toBe(51.0);
    expect($country->getLongitude())->toBe(9.0);
    expect($country->landlocked)->toBeFalse();
    expect($country->borders)->toBe(['AUT', 'BEL', 'CZE']);
    expect($country->area)->toBe(357114.0);
    expect($country->demonyms)->toBeInstanceOf(Collection::class);
    expect($country->demonyms->firstWhere('language', 'eng')->male)->toBe('German');
    expect($country->translations)->toBeInstanceOf(Collection::class);
    expect($country->translations->firstWhere('language', 'por')->common)->toBe('Alemanha');
    expect($country->flag)->toBe('🇩🇪');
    expect($country->maps->googleMaps)->toBe('https://goo.gl/maps/test');
    expect($country->population)->toBe(83491249);
    expect($country->gini)->toBe(['2016' => 31.9]);
    expect($country->fifa)->toBe('GER');
    expect($country->car->side)->toBe('right');
    expect($country->timezones)->toBe(['UTC+01:00']);
    expect($country->continents)->toBe(['Europe']);
    expect($country->flags->png)->toBe('https://flagcdn.com/w320/de.png');
    expect($country->flags->alt)->toBe('The flag of Germany');
    expect($country->coatOfArms->svg)->toBe('https://mainfacts.com/media/images/coats_of_arms/de.svg');
    expect($country->startOfWeek)->toBe('monday');
    expect($country->capitalInfo->getLatitude())->toBe(52.52);
    expect($country->postalCode->format)->toBe('#####');
});

// CountryField Enum
test('has all expected country fields', function () {
    $expectedFields = [
        'name', 'tld', 'cca2', 'ccn3', 'cioc', 'independent', 'status', 'unMember',
        'currencies', 'idd', 'capital', 'altSpellings', 'region', 'subregion',
        'languages', 'latlng', 'landlocked', 'borders', 'area', 'demonyms', 'cca3',
        'translations', 'flag', 'maps', 'population', 'gini', 'fifa', 'car',
        'timezones', 'continents', 'flags', 'coatOfArms', 'startOfWeek', 'capitalInfo', 'postalCode',
    ];

    $enumValues = array_map(fn (CountryField $field) => $field->value, CountryField::cases());

    expect($enumValues)->toBe($expectedFields);
});

// Error handling
test('returns null on http error', function () {
    $client = createMockedClient([new Response(404, [], '{"status":404,"message":"Not Found"}')]);
    $restCountries = new RestCountriesClass($client);

    expect($restCountries->getByCode('INVALID'))->toBeNull();
});

test('returns null on exception', function () {
    $mock = new MockHandler([new \GuzzleHttp\Exception\ConnectException('Connection failed', new \GuzzleHttp\Psr7\Request('GET', '/'))]);
    $handlerStack = HandlerStack::create($mock);
    $client = new Client(['handler' => $handlerStack]);

    $restCountries = new RestCountriesClass($client);

    expect($restCountries->getAll())->toBeNull();
});
