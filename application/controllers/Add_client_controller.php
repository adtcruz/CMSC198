<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_client_controller extends CI_Controller
{
	function __construct ()
	{
		parent::__construct ();
		session_start();
		$this->load->helper(array('form','url'));
	  $this->load->library(array('form_validation'));
	}

	function index() {
		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="admin")||($_SESSION["type"]==="technician")||($_SESSION["type"]==="superadmin")){

					$this->load->view('Add_client_view');
			}
		}

		else {
			$this->load->view('Login_view');
		}
	}
}

?>
