<?php

use getinstance\myapp\Actions\HomePageAction;
use getinstance\myapp\Actions\CountryAction;
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
};
