<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_selectable_material_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

        if(array_key_exists("materialID",$_POST)){

          if(array_key_exists("materialName",$_POST)){

            if(array_key_exists("materialCost",$_POST)){

              if(array_key_exists("materialUnitMeasurement",$_POST)){

                if(array_key_exists("materialDescription",$_POST)){

                  $this->load->database();

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
