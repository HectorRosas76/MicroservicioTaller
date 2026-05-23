<?php

//creacion de repositorio para contactos, similar al de vehiculos, con funciones list y detail, utilizando el controlador de contactos para obtener los datos

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
    function create(Request $request, Response $response)
    {
        try {
            $body = $request->getBody()->getContents();
            $data = json_decode($body, true);
            $controller = new Contacto_Controller();
            $contacto = $controller->guardarCliente($data);
            $dataJson = $contacto->toJson();
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

    function update(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        $body = $request->getBody()->getContents();
        $data = json_decode($body, true);
        $controller = new Contacto_Controller();
        $contacto = $controller->modificarCliente($id, $data);
        $dataResponse = $contacto->toJson();
        $response->getBody()->write($dataResponse);
        return $response
            ->withStatus(200)
            ->withHeader("Content-Type", 'application/json');
    }


    //help
    function delete(Request $request, Response $response, $args){
        $id = $args['id'];
        $controller = new Contacto_Controller();
        $estado = $controller->borrarCliente($id);
        $dataResponse = json_encode(['msg'=>'Cliente borrado']);
        $response->getBody()->write($dataResponse);
        return $response
            ->withStatus(200)
            ->withHeader("Content-Type", 'application/json');
    }
}