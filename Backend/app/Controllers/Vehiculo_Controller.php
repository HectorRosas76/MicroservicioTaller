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

//SE DEJA ID PARA MODIFICAR AL FUTURO


    function modificarVehiculo($id, $data){
        $vehiculo = $this->getVehiculo($id);
      $vehiculo->marca = $data['marca'];
      $vehiculo->modelo = $data['modelo'];
      $vehiculo->anio = $data['anio'];
    $vehiculo->estado_ENUM = empty($data['estado_ENUM']) ? null : $data['estado_ENUM'];
        $vehiculo->save();
        return $vehiculo;
    }
function guardarVehiculo($data)
    {
        if (empty($data['marca']) || empty($data['modelo'])) {
            throw new Exception("Falta la marca o el modelo", 1);
        }
        $vehiculo = new Vehiculo();
        $vehiculo->marca = $data['marca'];
        $vehiculo->modelo = $data['modelo'];
        $vehiculo->anio = $data['anio'];
        $vehiculo->estado_ENUM = empty($data['estado_ENUM']) ? null : $data['estado_ENUM'];
        $vehiculo->save();
        return $vehiculo;
    }
    function borrarVehiculo($id)
    {
        $vehiculo = $this->getVehiculo($id);
        $vehiculo->delete();
        return TRUE;
    }
}
