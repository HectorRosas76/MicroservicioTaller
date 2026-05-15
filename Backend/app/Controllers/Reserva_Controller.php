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
}