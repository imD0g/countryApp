<?php

use Slim\Factory\AppFactory;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use DI\ContainerBuilder;

// Require Composer's autoloader
require __DIR__ . '/../vendor/autoload.php';

// Load the settings
$settings = require __DIR__ . '/../settings.php';

// Create DI container
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    Environment::class => function () {
        // Load Twig templates from the templates/ directory
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        return new Environment($loader);
    },
]);

// Set container to create App with on AppFactory
$container = $containerBuilder->build();

// Create the Slim application instance with the container
$app = AppFactory::createFromContainer($container);

// Load the routes from the routes.php file
(require __DIR__ . '/../src/routes.php')($app);

// Run the application
$app->run();
