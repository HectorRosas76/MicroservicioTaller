<?php

namespace App\Controllers;

use App\Models\Reserva;
use Exception;

class Reserva_Controller
{
    function getreservas()
    {
        return Reserva::all();
    }

    function getreserva($id)
    {
        $reserva = Reserva::find($id);
        if (empty($reserva)) {
            throw new Exception("Reserva $id no existe", 2);
        }
        return $reserva;
    }

    // CRUD INCOMPLETO.
    //SE DEJA COMENTADO EL GUARDAR Y MODIFICAR PARA FUTURAS IMPLEMENTACIONES, SE DEJA EL ID PARA MODIFICAR AL FUTURO.
    function guardarReserva($data)
    {
        if (empty($data['cliente_id']) || empty($data['vehiculo_id'])) {
            throw new Exception("Falta el cliente o el vehículo", 1);
        }
        $reserva = new Reserva();
        $reserva->cliente_id = $data['cliente_id'];
        $reserva->vehiculo_id = $data['vehiculo_id'];
        // $reserva->telefono = empty($data['telefono']) ? null : $data['telefono'];
        $reserva->save();
        return $reserva;
    }
    function modificarReserva($id, $data)
    {
        $reserva = $this->getReserva($id);
          $reserva->cliente_id = $data['cliente_id'];
          $reserva->vehiculo_id = $data['vehiculo_id'];
        //       $reserva->telefono = empty($data['telefono']) ? null : $data['telefono'];
        $reserva->save();
        return $reserva;
    }
    function borrarReserva($id)
    {
        $reserva = $this->getReserva($id);
        $reserva->delete();
        return TRUE;
    }
}
