<?php

declare(strict_types=1);

namespace EwertonDaniel\RestCountries;

use EwertonDaniel\RestCountries\Contracts\RestCountriesInterface;
use EwertonDaniel\RestCountries\Data\Country;
use EwertonDaniel\RestCountries\Enums\CountryField;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

final readonly class RestCountries implements RestCountriesInterface
{
    private string $baseUrl;

    private ClientInterface $http;

    public function __construct(?ClientInterface $http = null)
    {
        $this->baseUrl = config('rest-countries.base_url', 'https://restcountries.com/v3.1');
        $this->http = $http ?? new Client([
            'verify' => config('rest-countries.http.verify', false),
            'timeout' => config('rest-countries.http.timeout', 30),
            'http_errors' => false,
        ]);
    }

    public function getAll(array $fields = []): ?Collection
    {
        if (empty($fields)) {
            $fields = [CountryField::Name, CountryField::Cca2];
        }

        $data = $this->request('/all', 'get all countries', [], $fields);

        return $data ? $this->toCollection($data) : null;
    }

    public function getIndependent(bool $status = true, array $fields = []): ?Collection
    {
        $statusParam = $status ? 'true' : 'false';

        $data = $this->request("/independent?status={$statusParam}", 'get independent countries', ['status' => $status], $fields);

        return $data ? $this->toCollection($data) : null;
    }

    public function getByName(string $name, array $fields = []): ?Collection
    {
        if (empty($name)) {
            return null;
        }

        $data = $this->request('/name/'.urlencode($name), 'get country by name', ['name' => $name], $fields);

        return $data ? $this->toCollection($data) : null;
    }

    public function getByFullName(string $name, array $fields = []): ?Country
    {
        if (empty($name)) {
            return null;
        }

        $data = $this->request('/name/'.urlencode($name).'?fullText=true', 'get country by full name', ['name' => $name], $fields);

        return $data && isset($data[0]) ? Country::fromArray($data[0]) : null;
    }

    public function getByCode(string $code, array $fields = []): ?Country
    {
        if (empty($code)) {
            return null;
        }

        $data = $this->request('/alpha/'.urlencode($code), 'get country by code', ['code' => $code], $fields);

        return $data && isset($data[0]) ? Country::fromArray($data[0]) : null;
    }

    public function getByCodes(array $codes, array $fields = []): ?Collection
    {
        if (empty($codes)) {
            return null;
        }

        $codesParam = implode(',', $codes);

        $data = $this->request("/alpha?codes={$codesParam}", 'get countries by codes', ['codes' => $codes], $fields);

        return $data ? $this->toCollection($data) : null;
    }

    public function getByCurrency(string $currency, array $fields = []): ?Collection
    {
        if (empty($currency)) {
            return null;
        }

        $data = $this->request('/currency/'.urlencode($currency), 'get countries by currency', ['currency' => $currency], $fields);

        return $data ? $this->toCollection($data) : null;
    }

    public function getByDemonym(string $demonym, array $fields = []): ?Collection
    {
        if (empty($demonym)) {
            return null;
        }

        $data = $this->request('/demonym/'.urlencode($demonym), 'get countries by demonym', ['demonym' => $demonym], $fields);

        return $data ? $this->toCollection($data) : null;
    }

    public function getByLanguage(string $language, array $fields = []): ?Collection
    {
        if (empty($language)) {
            return null;
        }

        $data = $this->request('/lang/'.urlencode($language), 'get countries by language', ['language' => $language], $fields);

        return $data ? $this->toCollection($data) : null;
    }

    public function getByCapital(string $capital, array $fields = []): ?Collection
    {
        if (empty($capital)) {
            return null;
        }

        $data = $this->request('/capital/'.urlencode($capital), 'get countries by capital', ['capital' => $capital], $fields);

        return $data ? $this->toCollection($data) : null;
    }

    public function getByCallingCode(string $code, array $fields = []): ?Collection
    {
        if (empty($code)) {
            return null;
        }

        $data = $this->request('/alpha?codes='.urlencode($code), 'get countries by calling code', ['callingCode' => $code], $fields);

        return $data ? $this->toCollection($data) : null;
    }

    public function getByRegion(string $region, array $fields = []): ?Collection
    {
        if (empty($region)) {
            return null;
        }

        $data = $this->request('/region/'.urlencode($region), 'get countries by region', ['region' => $region], $fields);

        return $data ? $this->toCollection($data) : null;
    }

    public function getBySubregion(string $subregion, array $fields = []): ?Collection
    {
        if (empty($subregion)) {
            return null;
        }

        $data = $this->request('/subregion/'.urlencode($subregion), 'get countries by subregion', ['subregion' => $subregion], $fields);

        return $data ? $this->toCollection($data) : null;
    }

    public function getByTranslation(string $translation, array $fields = []): ?Collection
    {
        if (empty($translation)) {
            return null;
        }

        $data = $this->request('/translation/'.urlencode($translation), 'get countries by translation', ['translation' => $translation], $fields);

        return $data ? $this->toCollection($data) : null;
    }

    /**
     * @param  CountryField[]  $fields
     */
    private function request(string $endpoint, string $operation, array $context = [], array $fields = []): ?array
    {
        try {
            $url = $this->baseUrl.$endpoint;

            if (count($fields) > 0) {
                $fieldValues = array_map(static fn (CountryField $field) => $field->value, $fields);
                $separator = str_contains($endpoint, '?') ? '&' : '?';
                $url .= $separator.'fields='.implode(',', $fieldValues);
            }

            $response = $this->http->request('GET', $url, [
                'headers' => ['Accept' => 'application/json'],
            ]);

            if ($response->getStatusCode() !== 200) {
                $this->log('warning', "Failed to {$operation}", array_merge($context, [
                    'status_code' => $response->getStatusCode(),
                    'response' => $response->getBody()->getContents(),
                ]));

                return null;
            }

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

            return is_array($data) ? $data : null;
        } catch (\Throwable $e) {
            $this->log('error', "Failed to {$operation}", array_merge($context, [
                'error' => $e->getMessage(),
            ]));

            return null;
        }
    }

    /**
     * @return Collection<int, Country>
     */
    private function toCollection(array $data): Collection
    {
        return collect($data)->map(static fn (array $item) => Country::fromArray($item));
    }

    private function log(string $level, string $message, array $context = []): void
    {
        $channel = config('rest-countries.log_channel', 'stack');

        Log::channel($channel)->{$level}("RestCountries: {$message}", $context);
    }
}
