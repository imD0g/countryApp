<?php

namespace getinstance\myapp\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;
use getinstance\myapp\Services\CountryApiService;

/**
 * Class CountryAction
 *
 * @package getinstance\myapp\Actions
 */
class CountryAction
{
    public function __construct(private CountryApiService $countryApiService, private Environment $twig)
    {
    }

    /**
     * Renders the countries page with data.
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function renderCountriesData(Request $request, Response $response): Response
    {
        // Render the index.twig template with the countryInfo data
        $data = ['countryInfo' => null];
        $html = $this->twig->render('index.twig', $data);
        $response->getBody()->write($html);
        return $response;
    }

    /**
     * Handles the country submission request and renders the country information in the template.
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function handleCountriesSubmit(Request $request, Response $response): Response
    {
        // Get the country from the request body
        $country = $request->getParsedBody()['country'] ?? '';
        $countryInfo = $this->countryApiService->getCountryInfo($country);

        // Render the index.twig template with the countryInfo data
        $data = ['countryInfo' => $countryInfo];
        $html = $this->twig->render('index.twig', $data);

        // Set the response body with the rendered template
        $response->getBody()->write($html);
        return $response;
    }
}
