<?php

namespace App\Presentation\Repositories;

use App\Controllers\Vehiculo_Controller;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class VehiculoRepository {
    function list(Request $request, Response $response) {
        $controller = new Vehiculo_Controller();
        $vehiculos = $controller->getVehiculos();
        $dataJson = $vehiculos->toJson();
        $response->getBody()->write($dataJson);
        return $response
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }

    function detail(Request $request, Response $response, array $args) {
        $id = $args['id'];
        $controller = new Vehiculo_Controller();
        try {
            $vehiculo = $controller->getVehiculo($id);
            $dataJson = $vehiculo->toJson();
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