<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_work_done_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				if(array_key_exists("workDoneID",$_POST)){

					if(array_key_exists("workDuration",$_POST)){

						if(array_key_exists("jobID",$_POST)){
							$this->load->database();

							$this->db->query("UPDATE materialsUsed SET materialUnits=".$_POST["workDuration"]." WHERE workDoneID=".$_POST["workDoneID"]."");

							$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." updated a work done for jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

							echo "Updated work done";

							return;
						}
					}
				}
			}
		}
	}
}
?>
