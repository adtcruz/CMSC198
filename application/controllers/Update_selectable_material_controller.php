<?php
//this is the controller for the API that updates the selectable material
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_selectable_material_controller extends CI_Controller
{
	public function index ()
	{

		//session start to access session variables
		session_start();

		//checks if type array key exists in session
		//if it does it means that there is a user in session
		if(array_key_exists("type",$_SESSION)){

			//if the user in session is either a superadmin, technician, or admin
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")){

				//checks if materialID, materialName, materialCost, materialUnitMeasurement, material description array keys exist in POST
        if(array_key_exists("materialID",$_POST)){
          if(array_key_exists("materialName",$_POST)){
            if(array_key_exists("materialCost",$_POST)){
              if(array_key_exists("materialUnitMeasurement",$_POST)){
                if(array_key_exists("materialDescription",$_POST)){

									//loads code igniter database module
                  $this->load->database();

									//updates materials details in the table
									//records the activity to the logs
									//returns a message that the material is updated
									$this->db->query("UPDATE materials SET materialName='".$_POST["materialName"]."', materialCost=".$_POST["materialCost"].", materialUnitMeasurement='".$_POST["materialUnitMeasurement"]."', materialDescription='".$_POST["materialDescription"]."' WHERE materialID=".$_POST["materialID"]."");
                  $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." modified a selectable material',CURRENT_TIMESTAMP)");
									echo "Selectable material updated";
									return;
                }
              }
            }
          }
        }
			}
		}
	}
}
?>
