<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			$this->load->view('Home_view');
		}

		else {

			$this->load->view('Login_view');
		}
	}
}
?>
