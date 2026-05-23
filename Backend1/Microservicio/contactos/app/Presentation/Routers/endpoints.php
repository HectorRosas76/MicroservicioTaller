<?php

use App\Presentation\Repositories\ContactosRepository;
use App\Presentation\Repositories\ReservaRepository;
use App\Presentation\Repositories\VehiculoRepository;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->group('/api', function (RouteCollectorProxy $group) {

 
        $group->group('/vehiculos', function (RouteCollectorProxy $group) {
            $group->get('', [VehiculoRepository::class, 'list']);
            $group->get('/{id}', [VehiculoRepository::class, 'detail']);
            $group->post('', [VehiculoRepository::class, 'create']);
            $group->put('/{id}', [VehiculoRepository::class, 'update']);
            $group->delete('/{id}', [VehiculoRepository::class, 'delete']);
        });

       
        $group->group('/contactos', function (RouteCollectorProxy $group) {
            $group->get('', [ContactosRepository::class, 'list']);
            $group->get('/{id}', [ContactosRepository::class, 'detail']);
            $group->post('', [ContactosRepository::class, 'create']);
            $group->put('/{id}', [ContactosRepository::class, 'update']);
            $group->delete('/{id}', [ContactosRepository::class, 'delete']);
        });

       
        $group->group('/reservas', function (RouteCollectorProxy $group) {
            $group->get('', [ReservaRepository::class, 'list']);
            $group->get('/{id}', [ReservaRepository::class, 'detail']);
            $group->post('', [ReservaRepository::class, 'create']);
            $group->put('/{id}', [ReservaRepository::class, 'update']);
            $group->delete('/{id}', [ReservaRepository::class, 'delete']);
        });

    });
};
