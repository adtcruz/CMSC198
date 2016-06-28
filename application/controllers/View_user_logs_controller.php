<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View_user_logs_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if($_SESSION["type"]==="superadmin"){

				$this->load->model('View_user_logs_model','vulm');

				$logsTable = $this->vulm->getLogEntries();

				$this->load->view('View_user_logs_view',array('logsTable' => $logsTable));

			}
		}

		else{

			$this->load->view('Login_view');
		}

	}
}
?>
