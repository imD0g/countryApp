<?php

namespace getinstance\myapp\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

/**
 * Class CallingCodeAction
 *
 * @package getinstance\myapp\Actions
 */
class CallingCodeAction
{
    public function __construct(private Environment $twig)
    {
    }

    /**
     * Renders the calling code page with data.
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function renderCallingCodeData(Request $request, Response $response): Response
    {
        // Render the capitalCity.twig template
        $html = $this->twig->render('callingCode.twig');
        $response->getBody()->write($html);
        return $response;


    }

}