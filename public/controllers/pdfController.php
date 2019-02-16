<?php
class pdfController extends Controller {
    
    private $_pdf;

    public function __construct() 
    {
        parent::__construct();
        $this->getLibrary('fpdf','fpdf'); //que esté disponible controlador completo
        $this->_pdf = new FPDF;
    }
    
    public function index() 
    {
        
    }
    
    public function pdf1($nombre = '¡Hola Mundo!', $apellido  = 'b') 
    //public function pdf1($nombre, $apellido) 
    {
        //http://sagrariobautizos.net/pdf/pdf1/byron/gustavo
        $this->_pdf->AddPage();
        $this->_pdf->SetFont('Arial','B',16);
        $this->_pdf->Cell(40,10, utf8_decode($nombre . ' ' . $apellido));
        $this->_pdf->Output();
        
    }
    public function pdf2($nombre, $apellido) 
    {
        //http://nuevaplantilla_mvc.net/pdf/pdf2/Byron/Gustavo
        $this->_pdf->AddPage();
        $this->_pdf->SetFont('Arial','B',16);
        $this->_pdf->Cell(40,10, utf8_decode($nombre . ' ' . $apellido));
        $this->_pdf->Output();
        
    }
    
    public function pdf3($nombre, $apellido)
    {
        
        //requerir de un archivo externo.
        require_once ROOT . 'public' . DS . 'files' . DS . 'pdf3.php';
        
    }
 }
