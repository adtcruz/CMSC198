<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class View_jobs_controller extends CI_Controller
{
	public function index ()
	{
		$this->load->view('View_jobs_view');
	}
}
?>