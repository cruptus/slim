<?php

require "../vendor/autoload.php";

$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

require "../src/container.php";

$app->get("/", \App\Controllers\DefaultController::class.':index');

$app->run();