<?php

namespace App\Controllers;

use App\Models\Vehiculo;
use Exception;

class Vehiculo_Controller {
    function getVehiculos(){
        return Vehiculo::all();
    }

    function getVehiculo($id){
        $vehiculo = Vehiculo::find($id);
        if(empty($vehiculo)){
            throw new Exception("Vehículo $id no existe", 2);
        }
        return $vehiculo;
    }
}