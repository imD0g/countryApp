<?php

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use getinstance\myapp\Services\CountryApiService;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;


class CountryApiServiceTest extends TestCase
{
    /** @var MockObject|Client */
    private $mockClient;

    /** @var CountryApiService */
    private $mockCountryApiService;

    /**
     * Override the setup method and create my mock objects here
     *
     * @return void
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Create the mock client
        $this->mockClient = $this->createMock(Client::class);
    }

    /**
     * Test the getCountryInfo method and ensure it returns a success.
     *
     * @return void
     */
    public function testGetCountryInfoReturnsSuccess()
    {
        //link
        $expected = [
            [
                'name' => [
                    'common' => 'United Kingdom'
                ],
                'capital' => 'London'
            ]
        ];

        /** @var MockObject|StreamInterface $mockBody */
        $mockBody = $this->createMock(Stream::class);

        /** @var MockObject|ResponseInterface $mockResponse */
        $mockResponse = $this->createMock(ResponseInterface::class);

        $mockBody
            ->method('getContents')
            ->willReturn(json_encode($expected)); // Link

        $mockResponse
            ->expects($this->any())
            ->method('getBody')
            ->willReturn($mockBody); // Link

        $this->mockClient
            ->expects($this->once())
            ->method('get')
            ->willReturn($mockResponse);

        $countryApiService = new CountryApiService($this->mockClient);
        $response = $countryApiService->getCountryInfo('GB');

        // Assert that the response is the same as the expected
        $this->assertEquals($expected[0], $response);
    }

    public function testGetCountryInfoReturnsError()
    {
        $errorMessage = "There was an error!";

         // Here we have to test getting into the guzzle exception
        $this->mockClient->expects($this->once())
            ->method('get')
            ->willThrowException(new Exception($errorMessage));

        $countryApiService = new CountryApiService($this->mockClient);
        $response = $countryApiService->getCountryInfo('....');

        // Assert the response is an array
        $this->assertIsArray($response, "Failed to assert that response was an array");

        // Assert the response array contains the "error" key
        $this->assertArrayHasKey("error", $response);

        // Assert the message in the response is the same as the defined string
        $this->assertEquals($errorMessage, $response["error"]);
    }

    public function testGetCountryInfoReturnsNull()
    {
        /** @var MockObject|ResponseInterface $mockResponse */
        $mockResponse = $this->createMock(ResponseInterface::class);

        /** @var MockObject|StreamInterface $mockBody */
        $mockBody = $this->createMock(StreamInterface::class);

        // Configure the mock body so it returns empty, using the getContents method
        $mockBody
            ->method('getContents')
            ->willReturn(json_encode([]));

        // Configure the mock response so it uses the get body method on the pre-created mockBody
        $mockResponse
            ->method('getBody')
            ->willReturn($mockBody);

        // Configure the mock client so it will return the mockResponse
        $this->mockClient
            ->expects($this->once())
            ->method('get')
            ->willReturn($mockResponse);

        $countryApiService = new CountryApiService($this->mockClient);
        $response = $countryApiService->getCountryInfo('NonExistentCountry');

        // Assert the response is null
        $this->assertNull($response, "Failed to assert that response was null");
    }
}
