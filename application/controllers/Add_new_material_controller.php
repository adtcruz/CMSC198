<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_new_material_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")){

				if(array_key_exists("materialName",$_POST)){

					if(array_key_exists("materialDescription",$_POST)){

						if(array_key_exists("materialCost",$_POST)){

							if(array_key_exists("materialUnitMeasurement",$_POST)){

								$this->load->database();

								$this->load->model('Job_requests_model','jrm');

								$this->db->query("INSERT INTO materials(materialName,materialDescription,materialCost,materialUnitMeasurement,dateCreated,createdBy,createdByType) VALUES ('".$_POST["materialName"]."','".$_POST["materialDescription"]."',".$_POST["materialCost"].",'".$_POST["materialUnitMeasurement"]."',CURDATE(),".$this->jrm->getUserID().",'".$_SESSION["type"]."')");

								$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." added a new material option',CURRENT_TIMESTAMP)");

								echo "Added new material option";

								return;
							}
						}
					}
				}
			}
		}
	}
}
?>
