<?php
//this is the controller for the API that makes a material visible
//to the 'select material' options
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Make_selectable_material_visible_controller extends CI_Controller
{
	public function index ()
	{

		//session start to access session variables
		session_start();

		//checks if type array key exists in session
		//if it does, it means that there is a user in session
		if(array_key_exists("type",$_SESSION)){

			//checks if the user in session is either a superadmin, technician, or admin
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")){

				//checks if materialID array key exists in POST
        if(array_key_exists("materialID",$_POST)){

					//loads code igniter database module
          $this->load->database();

					//sets the active column of the materialID to 1
  				$this->db->query("UPDATE materials SET active=1 WHERE materialID=".$_POST["materialID"]."");

					//record this action to the logs
          $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." made a material from the selectable choices visible',CURRENT_TIMESTAMP)");

					//sends a message that the selectable material is now visible
					echo "Selectable material made visible";

					//preterminates the script execution
					return;

        }
			}
		}
	}
}
?>
