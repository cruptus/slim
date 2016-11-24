<?php
$container = $app->getContainer();

/**
 * Définit si l'app est en mode debug ou non
 * @param $container
 * @return bool
 */
$container['debug'] = function ($container){
    return true;
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