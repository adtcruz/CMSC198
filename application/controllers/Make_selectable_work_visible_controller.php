<?php
//this is the controller for the API that makes a material visible
//to the 'select material' options
defined('BASEPATH') OR exit('No direct script access allowed');

class Make_selectable_work_visible_controller extends CI_Controller
{
	public function index ()
	{

		//session start to access session variables
		session_start();

		//checks if type array key exists in session
		//if it does, it means that there is a user in session
		if(array_key_exists("type",$_SESSION)){

			//checks if the user in session is either a superadmin, technician, or admin
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				//checks if workID array key exists in POST
        if(array_key_exists("workID",$_POST)){

					//loads code igniter database module
          $this->load->database();

					//sets the active column of the workID to 1
  				$this->db->query("UPDATE work SET active=1 WHERE workID=".$_POST["workID"]."");

					//record this action to the logs
          $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." made a work from the selectable choices visible',CURRENT_TIMESTAMP)");

					//sends a message that the selectable work is now visible
					echo "Selectable work made visible";

					//preterminates the script execution
					return;
        }
			}
		}
	}
}
?>
