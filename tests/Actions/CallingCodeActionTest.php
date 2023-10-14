<?php

namespace Actions;

use getinstance\myapp\Actions\CallingCodeAction;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\StreamInterface;
use Twig\Environment;


/**
 * Class CallingCodeActionTest
 *
 * @package tests\Actions
 */
class CallingCodeActionTest extends TestCase
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
     * Test the renderCallingCodeData method and ensure it returns a Response object
     *
     * @return void
     * @throws Exception
     */
    public function testRenderCallingCodeData(): void
    {
        // Create an instance of CallingCodeAction with the mock Twig environment
        $callingCodeAction = new CallingCodeAction($this->mockTwig);

        // Configure the response mock to return the stream mock when getBody is called
        $this->mockResponse->method('getBody')->willReturn($this->mockStream);

        // Call the method being tested
        $result = $callingCodeAction->renderCallingCodeData($this->mockRequest, $this->mockResponse);

        // Assert the result is a Response object
        $this->assertInstanceOf(Response::class, $result);
    }
}
