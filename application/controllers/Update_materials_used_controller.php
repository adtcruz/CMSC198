<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_materials_used_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				if(array_key_exists("materialsUsedID",$_POST)){

					if(array_key_exists("materialUnits",$_POST)){

						$this->load->database();

						$this->db->query("UPDATE materialsUsed SET materialUnits=".$_POST["materialUnits"]." WHERE materialsUsedID=".$_POST["materialsUsedID"]."");

						$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." updated a material for use in jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

						echo "Updated material";

						return;
					}
				}
			}
		}
	}
}
?>
