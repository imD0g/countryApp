<?php

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\Exception;
use getinstance\myapp\Actions\CountryAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\StreamInterface;
use Twig\Environment;
use getinstance\myapp\Services\CountryApiService;

/**
 * Class CountryActionTest
 *
 * @package tests\Actions
 */
class CountryActionTest extends TestCase
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

        $this->mockCountryApiService = $this->createMock(CountryApiService::class);
        $this->mockTwig = $this->createMock(Environment::class);
        $this->mockRequest  = $this->createMock(Request::class);
        $this->mockResponse  = $this->createMock(Response::class);
        $this->mockStream  = $this->createMock(StreamInterface::class);
    }

    /**
     * Test the renderCountriesData method and ensure it returns a Response object
     *
     * @return void
     * @throws Exception
     */
    public function testRenderCountriesData(): void
    {
        // Define expectations for the mock objects
        // Twig mock expectations:
        $this->mockTwig->expects($this->once())
            ->method('render')
            ->with($this->equalTo('index.twig'), $this->equalTo(['countryInfo' => null]))
            ->willReturn('Rendered HTML Content');

        // Request mock expectations:
        $this->mockResponse->expects($this->once())
            ->method('getBody')
            ->willReturn($this->mockStream);

        // Stream mock expectations:
        $this->mockStream->expects($this->once())
            ->method('write')
            ->with($this->equalTo('Rendered HTML Content'));

        // Create an instance of CountryAction with the mock dependencies
        $countryAction = new CountryAction($this->mockCountryApiService, $this->mockTwig);

        // Call the method being tested
        $result = $countryAction->renderCountriesData($this->mockRequest, $this->mockResponse);

        // Make assertions on the result,
        $this->assertInstanceOf(Response::class, $result);
    }

    /**
     * Test to ensure that the renderCountriesData method returns a Response object
     *
     * @return void
     * @throws Exception
     */
    public function testHandleCountriesSubmit():void
    {
        // Define expectations for the mock objects
        // Request mock expectations:
        $this->mockRequest->expects($this->once())
            ->method('getParsedBody')
            ->willReturn(['country' => 'Spain']);

        // CountryApiService mock expectations:
        $this->mockCountryApiService->expects($this->once())
            ->method('getCountryInfo')
            ->with($this->equalTo('Spain'))
            ->willReturn(['name' => 'Spain', 'capital' => "Madrid"]);

        // Twig mock expectations:
        $this->mockTwig->expects($this->once())
            ->method('render')
            ->with($this->equalTo('index.twig'), $this->equalTo(['countryInfo' => ['name' => 'Spain', 'capital' => "Madrid"]]))
            ->willReturn('Rendered HTML Content');

        // Response mock expectations:
        $this->mockResponse->expects($this->once())
            ->method('getBody')
            ->willReturn($this->mockStream);

        // Stream mock expectations:
        $this->mockStream->expects($this->once())
            ->method('write')
            ->with($this->equalTo('Rendered HTML Content'));

        // Create an instance of CountryAction with the mock dependencies
        $countryAction = new CountryAction($this->mockCountryApiService, $this->mockTwig);

        // Call the method being tested
        $result = $countryAction->handleCountriesSubmit($this->mockRequest, $this->mockResponse);

        // Assert the result is a Response object
        $this->assertInstanceOf(Response::class, $result);
    }
}
