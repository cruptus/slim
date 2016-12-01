<?php

namespace App\Controllers;

use App\Model\User;
use Slim\Http\Request;
use Slim\Http\Response;

class DefaultController extends Controller{

    /**
     * Rend la page par defaut
     * @param Request $request
     * @param Response $response
     */
    public function index(Request $request, Response $response){

        $this->render($response, "default/index.twig");
    }
}