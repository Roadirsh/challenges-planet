<?php 

/**
 * PDFController
 *
 * Making and generate a PDF
 *
 * @package     Framework_L&G
 * @copyright   L&G
 */

/**
 * HOME
 * CGU
 */
class PDFController extends CoreController {

    /**
     * Constructor
     */
    function __construct(){
        parent::__construct();
        
        if(isset($_GET['action'])){
            //ucfirt = put the first letter in Uppercase
            $action = ucfirst($_GET['action']);
            
            if(method_exists($this, $action)){
                $this->$action();
            } else{
                $this->corePage404();
            }

        } else {
            
            $this->GenerateTFPDF();
        }
    }


    /**
     * GENERATE WITH TFPDF
     *
     */
    public function GenerateTFPDF(){

        include('../lib/tfpdf/tfpdf.php');
        $pdf = new TFPDF();
        $pdf->AddPage();
        $pdf->SetFont('Bauhaus', 'Arial', 'B', 16);
        $pdf->Cell(40,10,"Apple ! ");
        $pdf->Output("../files/banana.pdf", "F");

        echo 'GenerateTFPDF';

    }

    /**
     * GENERATE WITH HTML 2 PDF
     *
     */
    public function GenerateHTML2PDF(){

        echo 'GenerateHTML2PDF';

    }

}