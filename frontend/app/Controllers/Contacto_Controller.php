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

    //Cambio Commit (Elimina Sebas)


//CRUD INCOMPLETO TALVEZ.
    //SE DEJA COMENTADO EL GUARDAR Y MODIFICAR PARA FUTURAS IMPLEMENTACIONES, SE DEJA EL ID PARA MODIFICAR AL FUTURO.
    // SE NECESITA INTEGRAR LOS NO NULOS
    //help
    function guardarcliente($data)
    {
        if (empty($data['nombre']) ) {
            throw new Exception("Falta el nombre", 1);
        }
        $cliente = new Cliente();
        $cliente->nombre = $data['nombre'];
        $cliente->correo = empty($data['correo']) ? null : $data['correo'];
        $cliente->telefono = empty($data['telefono']) ? null : $data['telefono'];
        $cliente->numero_licencia = empty($data['numero_licencia']) ? null : $data['numero_licencia'];
        $cliente->save();
      return $cliente;
    }
    function modificarCliente($id, $data){
        $cliente = $this->getCliente($id);
        $cliente->nombre = $data['nombre'];
        $cliente->correo = empty($data['correo']) ? null : $data['correo'];
        $cliente->telefono = empty($data['telefono']) ? null : $data['telefono'];
        $cliente->numero_licencia = empty($data['numero_licencia']) ? null : $data['numero_licencia'];
        $cliente->save();
        return $cliente;
    }

    function borrarCliente($id){
        $cliente = $this->getCliente($id);
        $cliente->delete();
        return TRUE;
    }
}
