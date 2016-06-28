<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate_bill_controller extends CI_Controller
{
	public function __construct ()
	{
		parent::__construct ();
		session_start();
		if(array_key_exists("type",$_SESSION)){
			$this->load->model ('Generate_bill_model', 'gbm');
		}
		else {
			die("You are not logged-in");
		}

	}

	public function index ()
	{
		$db_data = $this->gbm->getData ();

		$this->load->view ('Generate_bill_view', $db_data);
	}
}

?>
