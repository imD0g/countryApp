<?php

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use getinstance\myapp\Services\CountryApiService;
use GuzzleHttp\Client;
use PHPUnit\Framework\MockObject\Exception;

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

        // Create a custom mock for CountryApiService
        // Use the mock builder to build it in a way that we can bypass doing the actual API call
        $this->mockCountryApiService = $this->getMockBuilder(CountryApiService::class)
            ->setConstructorArgs([$this->mockClient])
            ->onlyMethods(['getCountryInfo'])
            ->getMock();
    }

    /**
     * Test the getCountryInfo method and ensure it returns a success.
     *
     * @return void
     */
    public function testGetCountryInfoReturnsSuccess()
    {
        // Define expected
        $expected = [
            'name' => [
                'common' => 'United Kingdom'
            ],
            'capital' => 'London'
        ];
        $this->mockCountryApiService->expects($this->once())
            ->method('getCountryInfo')
            ->with('GB')
            ->willReturn($expected);

        // Call the getCountryInfo method on the mock api call
        $response = $this->mockCountryApiService->getCountryInfo('GB');

        // Assert that the response is the same as the expected
        $this->assertEquals($expected, $response);
    }
}
