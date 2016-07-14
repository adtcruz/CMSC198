<?php
//this is the controller for the API that updates the selectable work
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_selectable_work_controller extends CI_Controller
{
	public function index ()
	{
		//session start to access session variables
		session_start();

		//checks if type array key exists in session
		if(array_key_exists("type",$_SESSION)){

			//if the user in session is either a superadmin, technician, or admin
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")){

				//checks if workID, workCost, and workDescription array keys are defined in POST
        if(array_key_exists("workID",$_POST)){
          if(array_key_exists("workCost",$_POST)){
            if(array_key_exists("workDescription",$_POST)){

							//loads code igniter database module
              $this->load->database();

							//updates the work in the database
							//records the action to the logs
							//sends a message that the selectable work was updated
      				$this->db->query("UPDATE work SET workCost=".$_POST["workCost"].", workDescription='".$_POST["workDescription"]."' WHERE workID=".$_POST["workID"]."");
              $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." modified a selectable work',CURRENT_TIMESTAMP)");
							echo "Selectable work updated";
							return;
            }
          }
        }
			}
		}
	}
}
?>
