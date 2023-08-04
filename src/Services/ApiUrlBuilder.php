<?php

namespace getinstance\myapp\Services;

/**
 * Class ApiUrlBuilder
 *
 * @package getinstance\myapp\Services
 */
class ApiUrlBuilder
{

    /**
     * Build the URL for the country request.
     *
     * @param string $country The name of the country.
     * @return string The complete API URL for the country request.
     */
    public function buildCountryUrl(string $country): string
    {
        $baseUrl = $this->getBaseUrl();
        return $baseUrl . "name/$country";
    }

    /**
     * Build the URL for the request.
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        return 'https://restcountries.com/v3.1/';
    }
}
