<?php

namespace App\Presentation\Repositories;

use App\Controllers\Contacto_Controller;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ContactoRepository {
    function list(Request $request, Response $response) {
        $controller = new Contacto_Controller();
        $contactos = $controller->getclientes();
        $dataJson = $contactos->toJson();
        $response->getBody()->write($dataJson);
        return $response
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }

    function detail(Request $request, Response $response, array $args) {
        $id = $args['id'];
        $controller = new Contacto_Controller();
        try {
            $contacto = $controller->getcliente($id);
            $dataJson = $contacto->toJson();
            $response->getBody()->write($dataJson);
            return $response
                ->withStatus(200)
                ->withHeader('Content-Type', 'application/json');
        } catch (Exception $e) {
            $errorData = ['error' => $e->getMessage()];
            $dataJson = json_encode($errorData);
            $response->getBody()->write($dataJson);
            return $response
                ->withStatus(404)
                ->withHeader('Content-Type', 'application/json');
        }
    }
}