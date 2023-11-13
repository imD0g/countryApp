<?php

namespace getinstance\myapp\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class CountryApiService
 *
 * @package getinstance\myapp\Services
 */
class CountryApiService
{
    public function __construct(private Client $httpClient)
    {
    }

    /**
     * Get country information from the API.
     *
     * @param string $country
     * @return array|null
     */
    public function getCountryInfo(string $country): ?array
    {
        try {

            // Make a GET request to the 'restcountries' API
            $response = $this->httpClient->get("https://restcountries.com/v3.1/name/$country");

            // Get the response body contents and decode the JSON contents into an array
            $countryData = json_decode($response->getBody()->getContents(), true);

            // If the data is not empty, return the first country in the response array
            if (!empty($countryData)) {
                return $countryData[0];
            }
        } catch (Exception $exception) {
            // Handle GuzzleException and return an error message
            return ['error' => $exception->getMessage()];
        }
        return null;
    }
}
