<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("listadoproductos_model");
    }

    public function index() {

        /**
         * Paginacion
         * */
        $this->load->library('pagination');

        $config['base_url'] = site_url('principal/index');
        $config['total_rows'] = $this->listadoproductos_model->num_productos();
        $config['per_page'] = 6;
//$config['uri_segment'] = 3;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

//Cargo todos los productos y se los paso a la vista mediante $data
        $data = array(
            'productos' => $this->listadoproductos_model->getPaginacion($config['per_page'])
        );

        $categorias = array(
            'categorias' => $this->listadoproductos_model->getCategorias()
        );

        $data['pagination'] = $this->pagination->create_links();

        /*
         * Cargar vista
         */
        $this->load->view('layouts/header');
        $this->load->view('layouts/aside', $categorias);
        $this->load->view('listadoproductos', $data);
        $this->load->view('layouts/footer');
    }

    public function categoria($id_cat, $pos = 0) {

        /**
         * Paginacion
         * */
        $this->load->library('pagination');

        $config['base_url'] = site_url('principal/categoria/' . $id_cat);
        $config['total_rows'] = $this->listadoproductos_model->num_productosCat($id_cat);
        $config['per_page'] = 6;
//$config['uri_segment'] = 3;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);


//Cargo todos los productos y se los paso a la vista mediante $data 
        $data = array(
            'productos' => $this->listadoproductos_model->categoria($id_cat, $config['per_page'], $pos)
        );

        $categorias = array(
            'categorias' => $this->listadoproductos_model->getCategorias()
        );

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside', $categorias);
        $this->load->view('listadoproductos', $data);
        $this->load->view('layouts/footer');
    }

    public function login() {
        $categorias = array(
            'categorias' => $this->listadoproductos_model->getCategorias()
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside', $categorias);
        $this->load->view('login');
        $this->load->view('layouts/footer');
    }

    public function registrar() {

        $this->load->model("provincias_model");

        $provincias = array(
            'provincias' => $this->provincias_model->provincias()
        );

        $categorias = array(
            'categorias' => $this->listadoproductos_model->getCategorias()
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside', $categorias);
        $this->load->view('registrar_usuario', $provincias);
        $this->load->view('layouts/footer');
    }

    public function producto($nombre) {

        $categorias = array(
            'categorias' => $this->listadoproductos_model->getCategorias()
        );

        $data = array(
            'producto' => $this->listadoproductos_model->producto($nombre)
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside', $categorias);
        $this->load->view('producto', $data);
        $this->load->view('layouts/footer');
    }

    public function exportar_productos() {
        header("Content-type: text/xml");
        header('Content-Disposition: attachment; filename="productos.xml"');
        $productosdb = $this->listadoproductos_model->getProductos();

        $xmlstr = <<<XML
<?xml version='1.0' encoding="iso-8859-1"?>
<productos></productos>
XML;

        $productos = new SimpleXMLElement($xmlstr);
        foreach ($productosdb->result() as $row) {
            $producto = $productos->addChild('producto');
            $producto->addChild('nombre', $row->nombre);
            $producto->addChild('descripcion', $row->descripcion);
            $producto->addChild('precio', $row->precio);
            $producto->addChild('stock', $row->stock);
            $producto->addChild('categoria_id', $row->categoria_id);
            $producto->addChild('estado', $row->estado);
            $producto->addChild('descuento', $row->descuento);
            $producto->addChild('imagen', $row->imagen);
            $producto->addChild('iva', $row->iva);
            $producto->addChild('fecha_inicio', $row->fecha_inicio);
            $producto->addChild('fecha_fin', $row->fecha_fin);
            $producto->addChild('destacado', $row->destacado);
        }


        echo $productos->asXML();
    }

    public function exportar_categorias() {
        header("Content-type: text/xml");
        header('Content-Disposition: attachment; filename="categorias.xml"');
        $productosdb = $this->listadoproductos_model->getCategoria();

        $xmlstr = <<<XML
<?xml version='1.0' encoding="iso-8859-1"?>
<categorias></categorias>
XML;

        $categorias = new SimpleXMLElement($xmlstr);
        foreach ($productosdb->result() as $row) {
            $producto = $categorias->addChild('categoria');
            $producto->addChild('nombre', $row->nombre);
            $producto->addChild('descripcion', $row->descripcion);
        }
        echo $categorias->asXML();
    }

    public function inportar_productos() {
        $config['upload_path'] = __DIR__ . "/../../assets/xml/";
        $config['allowed_types'] = 'xml';
        $config['file_name'] = 'productos.xml';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());

            // $this->load->view('upload_form', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        
        $xml = simplexml_load_file(__DIR__ . "/../../assets/xml/" . $data["upload_data"]["file_name"]);
        $truedata = [];

        foreach ($xml as $categoria) {
            $data = array(
                'nombre' => $categoria->nombre,
                "descripcion" => $categoria->descripcion,
                'precio' => $categoria->descripcion,
                "stock" => $categoria->stock,
                "categoria_id" => $categoria->categoria_id,
                "estado" => $categoria->estado,
                "descuento" => $categoria->descuento,
                "imagen" => $categoria->imagen,
                "iva" => $categoria->iva,
                "fecha_inicio" => $categoria->fecha_inicio,
                "fecha_fin" => $categoria->fecha_fin,
                "destacado" => $categoria->detacado,
            );

            array_push($truedata, $data);
        }
        $this->listadoproductos_model->insert_productos($truedata);
        redirect('principal');
    }
    
    public function importar_producto() {
        $categorias = array(
            'categorias' => $this->listadoproductos_model->getCategorias()
        );

        $this->load->view('layouts/header');
        $this->load->view('layouts/aside', $categorias);
        $this->load->view('subirxml');
        $this->load->view('layouts/footer');
    }

}
