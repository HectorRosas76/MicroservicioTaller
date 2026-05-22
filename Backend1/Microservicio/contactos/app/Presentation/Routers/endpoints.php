<?php

//use App\Presentation\Repositories\ContactosRepository;
//use App\Presentation\Repositories\TestRepository;

use App\Presentation\Repositories\VehiculoRepository;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/api', function (RouteCollectorProxy $group) {
        $group->get('/vehiculos', [VehiculoRepository::class, 'list']);
        $group->get('/vehiculo/{id}', [VehiculoRepository::class, 'detail']);
    });
};

//return function (App $app) {
//    $app->group('/api', function (RouteCollectorProxy $group) {
//        $group->get('/clientes', [ContactosRepository::class, 'list']);
//        $group->get('/clientes/{id}', [ContactosRepository::class, 'detail']);
 //   }); };
 // No se han editado los archivos de rutas, pero se han editado los archivos de controlador y repositorio relacionados con reservas y clientes.    
