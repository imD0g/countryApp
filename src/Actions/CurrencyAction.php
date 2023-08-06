<?php

namespace getinstance\myapp\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

/**
 * Class CurrencyAction
 *
 * @package getinstance\myapp\Actions
 */
class CurrencyAction
{
    public function __construct(private Environment $twig)
    {
    }

    /**
     * Renders the currency page with data.
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function renderCurrencyData(Request $request, Response $response): Response
    {
        // Render the curency.twig template
        $html = $this->twig->render('currency.twig');
        $response->getBody()->write($html);
        return $response;


    }

}