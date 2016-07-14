<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_account_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			$this->load->view('My_account_view');
		}

		else{

			$this->load->view('Login_view');
		}
	}
}
?>
