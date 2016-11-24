<?php

namespace App\Controllers;

use Slim\Http\Response;

class Controller
{

    private $container;

    public function __construct($container){
        $this->container = $container;
    }

    public function render(Response $response, $file){
        $this->container->view->render($response, $file);
    }
}