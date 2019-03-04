<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito_model extends CI_Model {

    public function crearventa() {
        $this->db->where("id", $this->session->userdata('id'));
        $usuario = $this->db->get('clientes');

        $usuario->row();

        $res = [];

        foreach ($usuario->result() as $row) {
            $res['nombre'] = $row->nombre;
            $res['apellidos'] = $row->apellidos;
            $res['telefono'] = $row->telefono;
            $res['direccion'] = $row->direccion;
            $res['correo'] = $row->correo;
        }

        $datos = array(
            'fecha' => date("Ymd"),
            'cliente_id' => $this->session->userdata('id'),
            'nombre' => $res['nombre'],
            'apellidos' => $res['apellidos'],
            'telefono' => $res['telefono'],
            'direccion' => $res['direccion'],
            'correo' => $res['correo'],
            'estado' => 'P'
        );
        $this->db->insert('venta', $datos);

        /*$idventa = $this->db->query("SELECT id FROM venta WHERE id = (SELECT MAX(id) from venta)");

        $idpedido = $idventa->row();*/

        $this->crearlineaspedido();
    }

    public function crearlineaspedido() {
        
        $idventa = $this->db->query("SELECT id FROM venta WHERE id = (SELECT MAX(id) from venta)");
        $idpedido = $idventa->row();
        
        foreach ($this->cart->contents() as $items):

            $datos = array(
                'producto_id' => $items['id'],
                'venta_id' => $idpedido->id,
                'precio' => $this->cart->format_number($items['subtotal']),
                'cantidad' => $items['qty']
            );
            $this->db->insert('detalle_venta', $datos);


        endforeach;
    }

}
