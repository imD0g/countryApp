<?php

use PHPUnit\Framework\TestCase;
use getinstance\myapp\Services\ApiUrlBuilder;

/**
 * Class ApiUrlBuilderTest
 *
 * @package tests\Services
 */
class ApiUrlBuilderTest extends TestCase
{
    /**
     * Test the buildCountryUrl method and ensure it returns the correct URL
     *
     * @return void
     */
    public function testBuildCountryUrl():void
    {
        // Create an instance of ApiUrlBuilder
        $urlBuilder = new ApiUrlBuilder();

        // Test with a country name
        $countryName = 'Spain';
        $expectedUrl = 'https://restcountries.com/v3.1/name/Spain';
        $actualUrl = $urlBuilder->buildCountryUrl($countryName);

        $this->assertEquals($expectedUrl, $actualUrl);

        // Test with another country name
        $countryName = 'Canada';
        $expectedUrl = 'https://restcountries.com/v3.1/name/Canada';
        $actualUrl = $urlBuilder->buildCountryUrl($countryName);

        $this->assertEquals($expectedUrl, $actualUrl);
    }

    /**
     * Test the buildCallingCodeUrl method and ensure it returns the correct URL
     *
     * @return void
     */
    public function testGetBaseUrl():void
    {
        // Create an instance of ApiUrlBuilder
        $urlBuilder = new ApiUrlBuilder();

        // Get the base URL
        $expectedBaseUrl = 'https://restcountries.com/v3.1/';
        $actualBaseUrl = $urlBuilder->getBaseUrl();

        $this->assertEquals($expectedBaseUrl, $actualBaseUrl);
    }
}
