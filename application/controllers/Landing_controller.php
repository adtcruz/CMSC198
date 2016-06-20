<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing_controller extends CI_Controller
{
	public function index ()
	{
		$this->load->view('Landing_view');
	}
}
?>