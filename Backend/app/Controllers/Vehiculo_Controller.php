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

//CRUD INCOMPLETO, SE DEJA ID PARA MODIFICAR AL FUTURO

    function modificarVehiculo($id, $data){
        $vehiculo = $this->getVehiculo($id);
      //  $vehiculo->nombre = $data['nombre'];
      //  $vehiculo->email = $data['email'];
 //       $vehiculo->telefono = empty($data['telefono']) ? null : $data['telefono'];
        $vehiculo->save();
        return $vehiculo;
    }
    }