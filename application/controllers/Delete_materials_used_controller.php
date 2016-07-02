<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete_materials_used_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				if(array_key_exists("materialsUsedID",$_POST)){

					$this->load->database();

					$jobID = $this->db->query("SELECT jobID FROM materialsUsed WHERE materialsUsedID=".$_POST["materialsUsedID"]."")->result_array()[0]["jobID"];

					$this->db->query("DELETE FROM materialsUsed WHERE materialsUsedID=".$_POST["materialsUsedID"]."");

					$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." deleted a material for jobID #".$jobID."',CURRENT_TIMESTAMP)");

					echo "Deleted material";

					return;
				}
			}
		}
	}
}
?>
