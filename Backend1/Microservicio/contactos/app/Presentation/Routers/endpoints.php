<?php

use App\Presentation\Repositories\ContactosRepository;
use App\Presentation\Repositories\ReservaRepository;
use App\Presentation\Repositories\VehiculoRepository;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->group('/api', function (RouteCollectorProxy $group) {

 
        $group->group('/vehiculos', function (RouteCollectorProxy $veh) {
            $veh->get('', [VehiculoRepository::class, 'list']);
            $veh->get('/{id}', [VehiculoRepository::class, 'detail']);
            $veh->post('', [VehiculoRepository::class, 'create']);
            $veh->put('/{id}', [VehiculoRepository::class, 'update']);
            $veh->delete('/{id}', [VehiculoRepository::class, 'delete']);
        });

       
        $group->group('/contactos', function (RouteCollectorProxy $cli) {
            $cli->get('', [ContactosRepository::class, 'list']);
            $cli->get('/{id}', [ContactosRepository::class, 'detail']);
            $cli->post('', [ContactosRepository::class, 'create']);
            $cli->put('/{id}', [ContactosRepository::class, 'update']);
            $cli->delete('/{id}', [ContactosRepository::class, 'delete']);
        });

       
        $group->group('/reservas', function (RouteCollectorProxy $res) {
            $res->get('', [ReservaRepository::class, 'list']);
            $res->get('/{id}', [ReservaRepository::class, 'detail']);
            $res->post('', [ReservaRepository::class, 'create']);
            $res->put('/{id}', [ReservaRepository::class, 'update']);
            $res->delete('/{id}', [ReservaRepository::class, 'delete']);
        });

    });
};
