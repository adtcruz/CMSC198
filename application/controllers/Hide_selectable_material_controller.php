<?php
//this is the controller for the API that hides a selectable material
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hide_selectable_material_controller extends CI_Controller
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

				//if materialID array key exists in POST
        if(array_key_exists("materialID",$_POST)){

					//loads codeigniter database module
          $this->load->database();

					//sets active column of the materialID to nought
  				$this->db->query("UPDATE materials SET active=0 WHERE materialID=".$_POST["materialID"]."");

					//record this action to the logs
          $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." hidden a material from the selectable choices',CURRENT_TIMESTAMP)");

					//sends a message that the selectable material is now hidden
					echo "Selectable material hidden";

					//preterminates the execution of the script
					return;
        }
			}
		}
	}
}
?>
