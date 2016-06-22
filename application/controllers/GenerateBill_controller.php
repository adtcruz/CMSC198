<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class GenerateBill_controller extends CI_Controller
{
	public function __construct ()
	{
		parent::__construct ();
		session_start();
		if(array_key_exists("type",$_SESSION)){
			$this->load->model ('GenerateBill_model', 'sm');
		}
		else {
			die("You are not logged-in");
		}

	}

	public function index ()
	{
		$db_data = $this->sm->getData ();
	
		$this->load->view ('genBill_view', $db_data);
	}
}

?>