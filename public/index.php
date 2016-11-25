<?php
session_start();
require "../vendor/autoload.php";

$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'database',
            'username' => 'username',
            'password' => 'password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ]
]);


/**
 * Ajout des containers
 */
require "../src/container.php";

$container = $app->getContainer();

// Database
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->get('settings')['db']);
$capsule->bootEloquent();


// CSRF
$guard = new \Slim\Csrf\Guard();
$app->add(new \App\Middlewares\CsrfMiddleware($container->view->getEnvironment(), $container->csrf));
// Ajout de la page d'erreur CSRF
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