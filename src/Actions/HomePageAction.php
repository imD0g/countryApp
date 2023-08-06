<?php

namespace getinstance\myapp\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

/**
 * Class HomePageAction
 *
 * @package getinstance\myapp\Actions
 */
class HomePageAction
{
    public function __construct(private Environment $twig)
    {
    }

    /**
     * Renders the home page, the invoke method is called when the route is matched.
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $data = [];
        $html = $this->twig->render('home.twig', $data);
        $response->getBody()->write($html);
        return $response;
    }
}
