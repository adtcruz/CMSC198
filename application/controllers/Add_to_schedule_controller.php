<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_to_schedule_controller extends CI_Controller
{
	public function index ()
	{
		session_start();
		if(array_key_exists("type",$_SESSION)){
			if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){

				//checks if jobID array key exists in post
			  if(array_key_exists("jobID",$_POST)){

					//loads Code Igniter database module
					$this->load->database();

					if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")) $adminID = $this->db->query("SELECT adminID FROM adminAcc WHERE username='".$_SESSION["username"]."'")->result_array()[0]["adminID"];
					if($_SESSION["type"]==="superadmin") $adminID = $this->db->query("SELECT superAdminID FROM superAdmin WHERE username='".$_SESSION["username"]."'")->result_array()[0]["superAdminID"];

					//inserts job to schedule
					$this->db->query("INSERT INTO schedule(jobID,dateCreated,createdBy,createdByType) VALUES (".$_POST["jobID"].",CURDATE(),".$adminID.",'admin')");

					if(count($this->db->query("SELECT jobID, adminID FROM job WHERE adminID=".$_POST["technicianID"]." AND jobID=".$_POST["jobID"]."")->result_array())==1){
						echo "Added";
					}
					else{
						echo "Can not add";
					}
        }
			}
		}
		else {
			die("You are not logged-in");
		}
	}
}
?>
