<?php
$container = $app->getContainer();

/**
 * Définit si l'app est en mode debug ou non
 * @return bool
 */
$container['debug'] = function (){
    return true;
};

/**
 * Retourne l'element CSRF et initialise la page d'erreur
 * @param $container
 * @return \Slim\Csrf\Guard
 */
$container['csrf'] = function () {
    return new \Slim\Csrf\Guard;
};

/**
 * Retourne l'élément Twig pour le render
 * @param $container
 * @return \Slim\Views\Twig
 */
$container['view'] = function ($container) {
    $dir = dirname(__DIR__);
    $view = new \Slim\Views\Twig($dir.'/src/views', [
        'cache' => ($container->debug) ? false : $dir.'/tmp/cache'
    ]);

    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->addExtension(new Twig_Extension_Debug());


    return $view;
};

/**
 * Erreur 404
 * @param $container
 * @return \App\Action\NotFoundHandler
 */
$container['notFoundHandler'] = function ($container) {
    return new App\Action\NotFoundHandler($container->get('view'), function ($request, $response) use ($container) {
        return $container['response']->withStatus(404);
    });
};

/**
 * Configuration de la base de donnée
 */
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->get('settings')['db']);
$capsule->bootEloquent();

/**
 * Contrer les failles CSRF
 */
$guard = new \Slim\Csrf\Guard();
$app->add(new \App\Middlewares\CsrfMiddleware($container->view->getEnvironment(), $container->csrf));
// Ajout de la page d'erreur CSRF
$guard->setFailureCallable(function($request, \Slim\Http\Response $response, $next) use ($container){
    $response->write($container->view->getEnvironment()->render("errors/csrf.twig"));
    $response = $response->withStatus(400);
    return $response;
});
$app->add($guard);

if($config['environment'] == 'development') {
    $provider = new Kitchenu\Debugbar\ServiceProvider();
    $provider->register($app);
    $debugbar = $app->getContainer()->get('debugbar');
    $debugbar->addCollector(new \DebugBar\DataCollector\PDO\PDOCollector(new DebugBar\DataCollector\PDO\TraceablePDO($capsule->getConnection('default')->getPdo())));
}