<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('carrito_model');
        $this->load->model("listadoproductos_model");
    }

    public function index() {

        $categorias = array(
            'categorias' => $this->listadoproductos_model->getCategorias()
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside', $categorias);
        $this->load->view('carrito');
        $this->load->view('layouts/footer');
    }

    /**
     * Funcion que inserta productos en el carrito mediante un array
     */
    public function inserta() {
        $id = $this->input->post("id");
        $nombre = $this->input->post("nombre");
        $precio = $this->input->post("precio");
        $cantidad = $this->input->post("cantidad");

        $data = array(
            'id' => $id,
            'qty' => $cantidad,
            'price' => $precio,
            'name' => $nombre
        );

        $categorias = array(
            'categorias' => $this->listadoproductos_model->getCategorias()
        );

        $this->cart->insert($data);

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside', $categorias);
        $this->load->view('carrito');
        $this->load->view('layouts/footer');
    }

    public function mostrarCarrito() {
        $categorias = array(
            'categorias' => $this->listadoproductos_model->getCategorias()
        );

        $this->cart->insert($data);
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside', $categorias);
        $this->load->view('carrito');
        $this->load->view('layouts/footer');
    }

    /**
     * Destruye el carrito
     */
    public function vaciarCarrito() {
        $this->cart->destroy();
        redirect('carrito');
    }

    /**
     * Funcion que altualiza el carrito
     */
    public function actualizarCarrito() {
        $data = $this->input->post();
        $this->cart->update($data);

        $categorias = array(
            'categorias' => $this->listadoproductos_model->getCategorias()
        );

        $this->cart->insert($data);
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside', $categorias);
        $this->load->view('carrito');
        $this->load->view('layouts/footer');
    }

    /**
     * Funcion para procesar el pedido de compra.
     */
    public function procesar() {
        $categorias = array(
            'categorias' => $this->listadoproductos_model->getCategorias()
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside', $categorias);
        $this->load->view('mostrarcompra');
        $this->load->view('layouts/footer');
    }

    public function realizarcompra() {
        $this->carrito_model->crearventa();
        $this->enviarcorreodetalle();
        
    }

    public function enviarcorreodetalle() {

        $rs = $this->db->query("select correo from clientes where id=" . $this->session->userdata('id'));
        $reg = $rs->row();
        $correo = $reg->correo;

        $correohtml = $this->load->view('tablacorreo', '', TRUE);

        $this->email->from('segundodaw2019@gmail.com', 'Isaac');
        $this->email->to($correo);
        //$this->email->cc('otro@otro-ejemplo.com');
        //$this->email->bcc('ellos@su-ejemplo.com');
        $this->email->subject('Detalle de pedido');
        $this->email->message($correohtml);
        $this->email->send();
        //echo $this->email->print_debugger();
        $this->cart->destroy();
        redirect('principal');
    }
    
    public function pedidos() {

        $categorias = array(
            'categorias' => $this->listadoproductos_model->getCategorias()
        );
        
        $pedidos = array(
            'pedidos' => $this->carrito_model->getpedidos()
        );
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside', $categorias);
        $this->load->view('pedidosrealizados', $pedidos);
        $this->load->view('layouts/footer');
    }
    
    public function detallepedido($id){
        
        $detalles = array(
            'detalles' => $this->carrito_model->getdetallepedido($id)
        );    
        
        /*$pedido = array(
            'pedido' => $this->carrito_model->getpedido($id)
        ); */
        
        $categorias = array(
            'categorias' => $this->listadoproductos_model->getCategorias()
        );
        
        /*$data['detalles'] = $detalles;
        $data['pedido'] = $pedido;*/
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside', $categorias);
        $this->load->view('detallepedido', $detalles);
        $this->load->view('layouts/footer');
    }

    public function anular($id){
        $this->carrito_model->anularpedido($id);
        redirect('carrito/pedidos');
    }

}
