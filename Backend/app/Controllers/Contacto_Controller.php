<?php

namespace App\Controllers;

use App\Models\Cliente  ;
use Exception;

class Contacto_Controller {
    function getclientes(){
        return Cliente::all();
    }

    function getcliente($id){
        $cliente = Cliente::find($id);
        if(empty($cliente)){
            throw new Exception("Cliente $id no existe", 2);
        }
        return $cliente;
    }
}