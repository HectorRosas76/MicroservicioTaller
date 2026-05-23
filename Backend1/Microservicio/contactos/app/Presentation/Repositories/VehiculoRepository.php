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
    
    function update(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $body = $request->getBody()->getContents();
        $data = json_decode($body, true);
        $controller = new Vehiculo_Controller();
        $vehiculo = $controller->modificarVehiculo($id, $data);
        $dataResponse = $vehiculo->toJson();
        $response->getBody()->write($dataResponse);
        return $response
            ->withStatus(200)
            ->withHeader("Content-Type", 'application/json');
    }

        function create(Request $request, Response $response)
    {
        try {
            $body = $request->getBody()->getContents();
            $data = json_decode($body, true);
            $controller = new Vehiculo_Controller();
            $vehiculo = $controller->guardarVehiculo($data);
            $dataJson = $vehiculo->toJson();
            $response->getBody()->write($dataJson);
            return $response
                ->withStatus(201)
                ->withHeader('Content-Type', 'application/json');
        } catch (Exception $ex) {
            $code = 400;
            if ($ex->getCode() == 1) {
                $code = 406;
                $response->getBody()->write(json_encode(['msg' => 'Datos erroneos']));
            } else {
                $response->getBody()->write(json_encode(['msg' => 'Error en el servicio']));
            }
            return $response
                ->withStatus($code)
                ->withHeader('Content-Type', 'application/json');
        }
    }
// NO se que hace $estado en el delete, se borra el vehiculo y se devuelve un mensaje, no se si es necesario devolver un estado o algo mas

    function delete(Request $request, Response $response, $args){
        $id = $args['id'];
        $controller = new Vehiculo_Controller();
       $estado = $controller->borrarVehiculo($id);
        $dataResponse = json_encode(['msg'=>'Vehículo borrado']);
        $response->getBody()->write($dataResponse);
        return $response
            ->withStatus(200)
            ->withHeader("Content-Type", 'application/json');
    }

}