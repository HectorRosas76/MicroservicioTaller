<?php

namespace App\Presentation\Repositories;

use App\Controllers\Reserva_Controller;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ReservaRepository {
    function list(Request $request, Response $response) {
        $controller = new Reserva_Controller();
        $reservas = $controller->getreservas();
        $dataJson = $reservas->toJson();
        $response->getBody()->write($dataJson);
        return $response
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }

    function detail(Request $request, Response $response, array $args) {
        $id = $args['id'];
        $controller = new Reserva_Controller();
        try {
            $reserva = $controller->getreserva($id);
            $dataJson = $reserva->toJson();
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