<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class To_pdf_controller extends CI_Controller {
 
    public function index()
    {        
        $data = [];

        $html = $this->load->view ("To_pdf_view", $data, true);

        //this the the PDF filename that user will get to download
        $pdfFilePath = "JobRequestForm.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }
}