<?php
//this is the controller for the API that hides a selectable work/service
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hide_selectable_work_controller extends CI_Controller
{
	public function index ()
	{

		//session start to access session variables
		session_start();

		//checks if type array key exist in session
		//if it does, it means that there is a user in session
		if(array_key_exists("type",$_SESSION)){

			//checks if the user in session is either a superadmin, technician, or admin
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")){

				//if workID array key exists in POST
        if(array_key_exists("workID",$_POST)){

					//loads codeigniter database module
          $this->load->database();

					//sets active column of the workID to nought
  				$this->db->query("UPDATE work SET active=0 WHERE workID=".$_POST["workID"]."");

					//record this action to the logs
          $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." hidden a work from the selectable choices',CURRENT_TIMESTAMP)");

					//sends a message that the selectable work is now hidden
					echo "Selectable work hidden";

					//preterminates the execution of the script
					return;
        }
			}
		}
	}
}
?>
