<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign_technician_controller extends CI_Controller
{
	public function index ()
	{
		session_start();
		if(array_key_exists("type",$_SESSION)){
			if(($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){

				//checks if officeID array key exists in post
				if(array_key_exists("technicianID",$_POST)){
				  if(array_key_exists("jobID",$_POST)){
  					//loads Code Igniter database module
  					$this->load->database();

						//sets job's adminID value from technician ID
  					$this->db->query("UPDATE job SET adminID=".$_POST["technicianID"].", jobStatus='PROCESSING' WHERE jobID=".$_POST["jobID"]."");

						if(count($this->db->query("SELECT jobID, adminID FROM job WHERE adminID=".$_POST["technicianID"]." AND jobID=".$_POST["jobID"]."")->result_array())==1){
							echo "Assigned";
						}
						else{
							echo "Can not assign";
						}
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
