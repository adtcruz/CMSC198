<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete_work_done_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				if(array_key_exists("workDoneID",$_POST)){

					$this->load->database();

					$jobID = $this->db->query("SELECT jobID FROM workDone WHERE workDoneID=".$_POST["workDoneID"]."")->result_array()[0]["jobID"];

					$this->db->query("DELETE FROM workDone WHERE workDoneID=".$_POST["workDoneID"]."");

					$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." deleted a material for jobID #".$jobID."',CURRENT_TIMESTAMP)");

					echo "Deleted work done";

					return;
				}
			}
		}
	}
}
?>
