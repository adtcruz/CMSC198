<?php
/*
* file: Add_materials_used_controller.php
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_materials_used_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				if(array_key_exists("jobID",$_POST)){

					if(array_key_exists("materialID",$_POST)){

						if(array_key_exists("materialUnits",$_POST)){

							$this->load->database();

							$this->load->model('Job_requests_model','jrm');

							$this->db->query("INSERT INTO materialsUsed(materialID,jobID,materialUnits,dateCreated,createdBy,createdByType) VALUES (".$_POST["materialID"].",".$_POST["jobID"].",".$_POST["materialUnits"].",CURDATE(),".$this->jrm->getUserID().",'".$_SESSION["type"]."')");

							$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." added a material for jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

							echo "Added new material";

							return;
						}
					}
				}
			}
		}
	}
}
?>
