<?php
/*
To_pdf_controller
This generates the PDF Job Request Form.
*/

// restrict direct access
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class To_pdf_controller extends CI_Controller {

	// constructor
	public function __construct ()
	{
		parent::__construct ();
	}

	// index function
	public function index()
	{
		// start session
		session_start();
		
		// load mpdf library
		$this->load->library('m_pdf');

		// if $_SESSION['username'] is set, continue. Else, show 404 page.
		if (!array_key_exists("username",$_SESSION))
		{
			show_404();
		}
		else
		{
			// initialize needed data here
			$data = [];

			// initialize the page to be converted to pdf
			$html = $this->load->view ("To_pdf_v2", $data, true);
			
			// set pdf file name
			$pdfFilePath = "JobRequestForm.pdf";
			
			// use mpdf function to write pdf
			$this->m_pdf->pdf->WriteHTML($html);
			
			// output the pdf then download
			$this->m_pdf->pdf->Output($pdfFilePath, "D");
		}
	}
}