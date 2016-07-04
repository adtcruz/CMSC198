<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_work_done_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				if(array_key_exists("jobID",$_POST)){

					if(array_key_exists("workID",$_POST)){

						if(array_key_exists("workDuration",$_POST)){

							$this->load->database();

							$this->load->model('Job_requests_model','jrm');

							$this->db->query("INSERT INTO workDone(workID,jobID,workDuration,dateCreated,createdBy,createdByType) VALUES (".$_POST["workID"].",".$_POST["jobID"].",CURDATE(),".$_POST["workDuration"].",".$this->jrm->getUserID().",'".$_SESSION["type"]."')");

							$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." added a work done for jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

							echo "Added work done";

							return;
						}
					}
				}
			}
		}
	}
}
?>
