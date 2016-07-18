<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate_bill_controller extends CI_Controller
{
	public function __construct ()
	{
		parent::__construct ();
		session_start();
        $this->load->model ('Generate_bill_model', 'gbm');
	}

	public function index ()
	{
    if(array_key_exists("type",$_SESSION))
    {
	    $db_data = $this->gbm->getData ($_SESSION['username']);
  		$this->load->view ('Generate_bill_view', $db_data);
		}
		else
    {
			$this->load->view('Login_view');
		}
	}
}

?>
