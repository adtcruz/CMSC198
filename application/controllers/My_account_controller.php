<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_account_controller extends CI_Controller
{
	public function index ()
	{
		$this->load->view('My_account_view');
	}
}
?>
