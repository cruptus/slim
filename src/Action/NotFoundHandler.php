<?php
namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Handlers\NotFound;
use Slim\Views\Twig;

class NotFoundHandler extends NotFound{

    private $view;

    public function __construct(Twig $view) {
        $this->view = $view;
    }

    /**
     * Retourne la page d'erreur 404
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return static
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {
        parent::__invoke($request, $response);

        $this->view->render($response, 'errors/404.twig');

        return $response->withStatus(404);
    }

}

