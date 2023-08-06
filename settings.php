<?php

require_once __DIR__ . '/vendor/autoload.php';

// Load the .env file to set environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    // Add .env settings from here
    'API_BASE_URL' => $_ENV['API_BASE_URL'],
];
