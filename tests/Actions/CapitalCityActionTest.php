<?php

namespace Actions;

use getinstance\myapp\Actions\CallingCodeAction;
use getinstance\myapp\Actions\CapitalCityAction;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\StreamInterface;
use Twig\Environment;


/**
 * Class CapitalCityActionTest and ensure it returns a Response object
 *
 * @package tests\Actions
 */
class CapitalCityActionTest extends TestCase
{
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

        $this->mockTwig = $this->createMock(Environment::class);
        $this->mockRequest  = $this->createMock(Request::class);
        $this->mockResponse  = $this->createMock(Response::class);
        $this->mockStream  = $this->createMock(StreamInterface::class);
    }

    /**
     * Test the renderCapitalCityData method
     *
     * @return void
     * @throws Exception
     */
    public function testRenderCapitalCityData():void
    {
        // Create an instance of CallingCodeAction with the mock Twig environment
        $capitalCityAction = new CapitalCityAction($this->mockTwig);

        // Configure the response mock to return the stream mock when getBody is called
        $this->mockResponse->method('getBody')->willReturn($this->mockStream);

        // Call the method being tested
        $result = $capitalCityAction->renderCapitalCityData($this->mockRequest, $this->mockResponse);

        // Assert the result is a Response object
        $this->assertInstanceOf(Response::class, $result);
    }
}
