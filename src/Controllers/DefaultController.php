<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class DefaultController extends Controller{

    public function index(Request $request, Response $response){
        $this->render($response, "default/index.twig");
    }
}