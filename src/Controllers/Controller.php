<?php

namespace App\Controllers;

use Slim\Http\Response;

class Controller
{

    private $container;

    public function __construct($container){
        $this->container = $container;
    }

    /**
     * Fonction qui permet de rendre une page
     * @param Response $response
     * @param $file
     */
    public function render(Response $response, $file){
        $this->container->view->render($response, $file);
    }
}