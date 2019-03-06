<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

}

class Pagina_PDF extends Fpdf\Fpdf {

    function Header() {
        // Select Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        //$this->Cell(80);
        // Framed title
        $this->Cell(0, 10, 'Tienda Online, Isaac Ogazon', "B", 0, 'C');
        // Line break
        $this->Ln(20);
    }

    function Footer() {
        $this->Ln(20);
        // Select Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        //$this->Cell(0);
        // Framed title
        $this->Cell(0, 10, 'Tienda Online, Isaac Ogazon', "B", 0, 'C');
        // Line break
        $this->Ln(20);
    }
    
    function encabezado($datosusuario) {

        $this->SetFont('Arial', '', 15);
        $this->Cell(100);
        $this->Cell(0,8, utf8_decode($datosusuario->nombre.' '.$datosusuario->apellidos) ,0,1);
        $this->Cell(100);
        $this->Cell(0,8,$datosusuario->dni ,0,1);
        $this->Cell(100);
        $this->Cell(0,8,$datosusuario->telefono ,0,1);
        $this->Cell(100);
        $this->Cell(0,8, utf8_decode($datosusuario->direccion) ,0,1);
        $this->Cell(100);
        $this->Cell(0,8,$datosusuario->cp ,0,1);
        $this->Cell(100);
        $this->Cell(0,8,$datosusuario->correo ,0,1);
        $this->Cell(100);
        $this->Ln(10);
        
    }
    
    // Una tabla más completa
    function ImprovedTable($header, $data) {
        // Anchuras de las columnas
        $w = array(50, 50, 50);
        $this->Cell(15,7, '', 0);
        // Cabeceras
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->Ln();
        // Datos
        foreach ($data as $row) {
            $this->Cell(15,7, '', 0);
            $this->Cell($w[0], 6, $row->producto_id, 'LR');
            $this->Cell($w[1], 6, $row->precio, 'LR');
            $this->Cell($w[2], 6, $row->cantidad, 'LR', 0, 'R');
            $this->Ln();
        }
        // Línea de cierre
        $this->Cell(15,7, '', 0);
        $this->Cell(array_sum($w), 0, '', 'T');
    }

}
