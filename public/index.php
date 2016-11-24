<?php
session_start();
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

$container = $app->getContainer();


// CSRF
$app->add(new \App\Middlewares\CsrfMiddleware($container->view->getEnvironment(), $container->csrf));

$guard = new \Slim\Csrf\Guard();
$guard->setFailureCallable(function($request, \Slim\Http\Response $response, $next) use ($container){
    $response->write($container->view->getEnvironment()->render("errors/csrf.twig"));
    $response = $response->withStatus(400);
    return $response;
});
$app->add($guard);

/**
 * Les routes
 */
$app->get("/", \App\Controllers\DefaultController::class.':index');
$app->post("/", \App\Controllers\DefaultController::class.':index')->setName("test");


/**
 * Lancement de l'application
 */
$app->run();