<?php

use getinstance\myapp\Actions\HomePageAction;
use getinstance\myapp\Actions\CountryAction;
use getinstance\myapp\Actions\CurrencyAction;
use getinstance\myapp\Actions\CapitalCityAction;
use getinstance\myapp\Actions\CallingCodeAction;

use Slim\App;

/**
 * Defines the routes for the Country App.
 *
 * @param App $app The Slim application instance.
 */
return function (App $app) {
    // Home route
    $app->get('/', HomePageAction::class);

    // Countries route
    $app->get('/countries', CountryAction::class . ':renderCountriesData');

    // Country submission route
    $app->post('/countries', CountryAction::class . ':handleCountriesSubmit');

    // Currency route
    $app->get('/currency', CurrencyAction::class . ':renderCurrencyData');

    // Capital City route
    $app->get('/capitalCity', CapitalCityAction::class . ':renderCapitalCityData');

    // Calling code route
    $app->get('/callingCode', CallingCodeAction::class . ':renderCallingCodeData');
};
