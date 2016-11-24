<?php

require "../vendor/autoload.php";

$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

/**
 * Ajout des containers
 */
require "../src/container.php";


/**
 * Les routes
 */
$app->get("/", \App\Controllers\DefaultController::class.':index');


/**
 * Lancement de l'application
 */
$app->run();