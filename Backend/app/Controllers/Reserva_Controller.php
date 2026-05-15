<?php

namespace App\Controllers;

use App\Models\Reserva;
use Exception;

class Reserva_Controller {
    function getreservas(){
        return Reserva::all();
    }

    function getreserva($id){
        $reserva = Reserva::find($id);
        if(empty($reserva)){
            throw new Exception("Reserva $id no existe", 2);
        }
        return $reserva;
    }

// CRUD INCOMPLETO.
    //SE DEJA COMENTADO EL GUARDAR Y MODIFICAR PARA FUTURAS IMPLEMENTACIONES, SE DEJA EL ID PARA MODIFICAR AL FUTURO.
    function guardarReserva($data)
    {
        if (empty($data['nombre']) || empty($data['email'])) {
            throw new Exception("Falta el nombre o el email", 1);
        }
        $reserva = new Reserva();
        $reserva->nombre = $data['nombre'];
//        $reserva->email = $data['email'];
 //       $reserva->telefono = empty($data['telefono']) ? null : $data['telefono'];
 //       $reserva->save();
      return $reserva;
    }
    function modificarReserva($id, $data){
        $reserva = $this->getReserva($id);
      //  $reserva->nombre = $data['nombre'];
      //  $reserva->email = $data['email'];
 //       $reserva->telefono = empty($data['telefono']) ? null : $data['telefono'];
        $reserva->save();
        return $reserva;
    }
    function borrarReserva($id){
        $reserva = $this->getReserva($id);
        $reserva->delete();
        return TRUE;
    }
}
