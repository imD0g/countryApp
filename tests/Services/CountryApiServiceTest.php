<?php

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\Exception;
use getinstance\myapp\Services\CountryApiService;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\StreamInterface;
use Twig\Environment;

class CountryApiServiceTest extends TestCase
{
    /** @var MockObject|CountryApiService */
    private $mockCountryApiService;

    /** @var MockObject|Environment */
    private $mockTwig;

    /** @var MockObject|Request */
    private $mockRequest;

    /** @var MockObject|Response */
    private $mockResponse;

    /** @var MockObject|StreamInterface */
    private $mockStream;

    /**
     * Override the setup method and create my mock objects here
     *
     * @throws Exception
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Clean this so its only guzzle / client for contstructor
        $this->mockCountryApiService = $this->createMock(CountryApiService::class);
        $this->mockTwig = $this->createMock(Environment::class);
        $this->mockRequest  = $this->createMock(Request::class);
        $this->mockResponse  = $this->createMock(Response::class);
        $this->mockStream  = $this->createMock(StreamInterface::class);
    }

    /**
     * Test the getCountryInfo method and ensure it returns a success
     *
     * @return void
     */
    public function testGetCountryInfoReturnsSuccess()
    {
        // Create an instance of CountryApiService with the mock Guzzle client
        $countryApiService = new CountryApiService(new Client());

        // Call the getCountryInfo method and pass in a country code
        $response = $countryApiService->getCountryInfo('GB');

        // Assert that the response is an array (you may need to adjust this assertion based on your actual response type)
        $this->assertIsArray($response);

        // Assert that the "error" key does not exist in the response
        $this->assertArrayNotHasKey('error', $response);
    }

    /**
     * Test the getCountryInfo method and ensure it returns a failure
     *
     * @return void
     */
    public function testGetCountryInfoReturnsFailure()
    {
        // Create an instance of CountryApiService with the mock Guzzle client
        $countryApiService = new CountryApiService(new Client());

        // Call the getCountryInfo method with an invalid country code that you know will result in an error
        $response = $countryApiService->getCountryInfo('test_invalid_country_code');

        // Assert that the response is an array (you may need to adjust this assertion based on your actual response type)
        $this->assertIsArray($response);

        // Assert that the "error" key exists in the response
        $this->assertArrayHasKey('error', $response);
    }
}
