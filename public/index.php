<?php
session_start();
require "../vendor/autoload.php";
require "../src/config.php";

$app = new Slim\App($settings);

/**
 * Ajout des containers
 */
require "../src/container.php";

/**
 * Ajout des routes
 */
require "../src/routes.php";

/**
 * Lancement de l'application
 */
$app->run();