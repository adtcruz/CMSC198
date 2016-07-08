<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_new_work_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")){

				if(array_key_exists("workDescription",$_POST)){

					if(array_key_exists("workCost",$_POST)){

						$this->load->database();

						$this->load->model('Job_requests_model','jrm');

						$this->db->query("INSERT INTO work(workDescription,workCost,dateCreated,createdBy,createdByType) VALUES ('".$_POST["workDescription"]."',".$_POST["workCost"].",CURDATE(),".$this->jrm->getUserID().",'".$_SESSION["type"]."')");

						$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." added a new work option',CURRENT_TIMESTAMP)");

						echo "Added new work option";

						return;
					}
				}
			}
		}
	}
}
?>
