<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class To_pdf_controller extends CI_Controller {

	public function __construct ()
	{
		parent::__construct ();
		include APPPATH . 'third_party/MPDF/mpdf.php';
	}

	public function index()
	{
		// initialize data here
		$data = [];
		// initialize the page to be converted to pdf
		$html = $this->load->view ("To_pdf_view", $data, true);
		// set pdf file name
		$pdfFilePath = "JobRequestForm.pdf";
		// load mpdf library
		$this->load->library('m_pdf');
		// use mpdf function to write pdf
		$this->m_pdf->pdf->WriteHTML($html);
		// output the pdf then download
		$this->m_pdf->pdf->Output($pdfFilePath, "D");
	}
}