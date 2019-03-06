<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Examples extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->model("listadoproductos_model");
        $this->load->library('grocery_CRUD');
    }

    public function _example_output($output = null) {
        
        $categorias = array(
            'categorias' => $this->listadoproductos_model->getCategorias()
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside', $categorias);
        $this->load->view('example.php', (array) $output);
        $this->load->view('layouts/footer');
        
        
    }

    public function muestraproductos() {

        $crud = new grocery_CRUD();
        $crud->set_table('productos');
        //$crud->columns('nombre', 'codigo', 'descripcion', 'precio', 'cantidad_dispo');

        $output = $crud->render();

        $this->_example_output($output);
    }
    
    public function muestracategorias() {

        $crud = new grocery_CRUD();
        $crud->set_table('categorias');
        //$crud->columns('nombre', 'codigo', 'descripcion', 'precio', 'cantidad_dispo');

        $output = $crud->render();

        $this->_example_output($output);
    }
    
    public function muestrapedidos() {

        $crud = new grocery_CRUD();
        $crud->set_table('venta');
        //$crud->columns('nombre', 'codigo', 'descripcion', 'precio', 'cantidad_dispo');

        $output = $crud->render();

        $this->_example_output($output);
    }

}
