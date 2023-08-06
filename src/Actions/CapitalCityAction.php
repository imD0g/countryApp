<?php

namespace getinstance\myapp\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

/**
 * Class CapitalCityAction
 *
 * @package getinstance\myapp\Actions
 */
class CapitalCityAction
{
    public function __construct(private Environment $twig)
    {
    }

    /**
     * Renders the capital page with data.
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function renderCapitalCityData(Request $request, Response $response): Response
    {
        // Render the capitalCity.twig template
        $html = $this->twig->render('capitalCity.twig');
        $response->getBody()->write($html);
        return $response;
    }

}