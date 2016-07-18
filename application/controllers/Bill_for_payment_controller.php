<?php
/*
*   file:  Bill_for_payment_controller.php
*       this controller will create a PDF of the bill that should be paid by the client
*/
if ( !defined('BASEPATH')) exit('No direct script access allowed');
class Bill_for_payment_controller extends CI_Controller
{
	// constructor
	public function __construct ()
	{
		parent::__construct ();
		session_start ();
        $this->load->model ('Bill_for_payment_model', 'bfp');
        $this->load->model ('Notifications_model', 'nm');
	}
	// index function
	public function index()
	{
		// if $_SESSION['username'] is set, continue. Else, show 404 page.
		if ($_SESSION['type'] != 'client' || !array_key_exists("username",$_SESSION))
		{
			show_404();
		}
		else
		{
      // add call to insert notifications
      $this->nm->notifBillGenerated ($_SESSION['username'], $this->uri->segment(2));
      // load mpdf library
			$this->load->library('m_pdf');
      // get data from database
      $db_data = $this->bfp->getData ($this->uri->segment(2));
			// initialize the page to be converted to pdf
			$html = $this->load->view ("Bill_for_payment_view", $db_data, true);
			// set pdf file name
			$pdfFilePath = "BillForPayment.pdf";
			// use mpdf function to write pdf
			$this->m_pdf->pdf->WriteHTML($html);
			// output the pdf then download
			$this->m_pdf->pdf->Output(); // add $pdfFilePath and "D" as parameters download automatically*/
		}
	}
}
