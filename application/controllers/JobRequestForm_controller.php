<?php
/*
To_pdf_controller
This generates the PDF Job Request Form.
*/

// restrict direct access
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class JobRequestForm_controller extends CI_Controller {

	// constructor
	public function __construct ()
	{
		parent::__construct ();
		$this->load->model('JobRequestForm_model', 'jrf', TRUE);
		session_start ();
	}

	// index function
	public function index()
	{		
		// if $_SESSION['username'] is set, continue. Else, show 404 page.
		if (!array_key_exists("username",$_SESSION))
		{
			show_404();
		}
		else
		{
			// load mpdf library
			$this->load->library('m_pdf');		
			$db_data = $this->jrf->getData ();

			// initialize the page to be converted to pdf
			$html = $this->load->view ("JobRequestForm_view", $db_data, true);
			
			// set pdf file name
			$pdfFilePath = "JobRequestForm.pdf";
			
			// use mpdf function to write pdf
			$this->m_pdf->pdf->WriteHTML($html);
			
			// output the pdf then download
			$this->m_pdf->pdf->Output(); // add $pdfFilePath and "D" as parameters download automatically
		}
	}
}