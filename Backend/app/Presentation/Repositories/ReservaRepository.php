<?php

//creacion de repositorio para reservas, similar al de contactos, con funciones list y detail, utilizando el controlador de reservas para obtener los datos

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

    //Aqui para abajo cosas de crear, modificar y borrar reservas, utilizando el controlador de reservas para realizar las operaciones, 
    //y devolviendo respuestas JSON con el resultado de la operación. Se manejan excepciones para errores comunes como datos faltantes o reserva no encontrada.
//    function create(Request $request, Response $response)
//    {
//        try {
//            $body = $request->getBody()->getContents();
//            $data = json_decode($body, true);
//            $controller = new Reserva_Controller();
//            $reserva = $controller->guardarReserva($data);
//            $dataJson = $reserva->toJson();
//            $response->getBody()->write($dataJson);
//            return $response
//                ->withStatus(201)
//                ->withHeader('Content-Type', 'application/json');
//        } catch (Exception $ex) {
//            $code = 400;
//            if ($ex->getCode() == 1) {
//                $code = 406;
//                $response->getBody()->write(json_encode(['msg' => 'Datos erroneos']));
//            } else {
//                $response->getBody()->write(json_encode(['msg' => 'Error en el servicio']));
//            }
//            return $response
//                ->withStatus($code)
//                ->withHeader('Content-Type', 'application/json');
//        }
//    }
//
//    function update(Request $request, Response $response, $args)
//    {
//        $id = $args['id'];
//        $body = $request->getBody()->getContents();
//        $data = json_decode($body, true);
//        $controller = new Reserva_Controller();
//        $reserva = $controller->modificarReserva($id, $data);
//        $dataResponse = $reserva->toJson();
//        $response->getBody()->write($dataResponse);
//        return $response
//            ->withStatus(200)
//            ->withHeader("Content-Type", 'application/json');
//    }
//
//
//    //help
//    function delete(Request $request, Response $response, $args){
//        $id = $args['id'];
//     //   $controller = new Reserva_Controller();
//     //   $estadoENUM = $controller->borrarReserva($id);
//        $dataResponse = json_encode(['msg'=>'Reserva borrada']);
//        $response->getBody()->write($dataResponse);
//        return $response
//            ->withStatus(200)
//            ->withHeader("Content-Type", 'application/json');
//    }
}