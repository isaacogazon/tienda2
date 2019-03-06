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
            'estado' => 'PR'
        );

        if (!$this->session->userdata('login')) {
            redirect('auth');
        } else {
            $this->db->insert('venta', $datos);
            $this->crearlineaspedido();
        }
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
            $this->restarstock($items['id'], $items['qty']);
        endforeach;
    }

    public function restarstock($idproducto, $restar) {

        $productos = $this->db->query("SELECT stock FROM productos WHERE id = " . $idproducto);
        $cant = $productos->row();
        $resto = $cant->stock - $restar;

        $data = array(
            'stock' => $resto
        );
        $this->db->where('id', $idproducto);
        $this->db->update('productos', $data);
    }
    
    public function getdetallepedidoultimo(){
        $idventa = $this->db->query("SELECT id FROM venta WHERE id = (SELECT MAX(id) from venta)");
        $idpedido = $idventa->row();
        return $idpedido;
    }

    public function getpedidos() {
        $this->db->where('cliente_id =' . $this->session->userdata('id'));
        $resultados = $this->db->get("venta");
        return $resultados->result();
    }

    public function getpedido($id) {

        $this->db->where("id", $id);
        $detalles = $this->db->get('venta');
        return $detalles->row();
    }

    public function getdetallepedido($id) {

        $this->db->where("venta_id", $id);
        $detalles = $this->db->get('detalle_venta');
        return $detalles->result();
    }

    public function anularpedido($id) {
        $this->db->where('venta_id', $id);
        $this->db->delete('detalle_venta');

        $this->db->where('id=' . $id . ' AND estado = "PR"');
        $this->db->delete('venta');
    }

}
