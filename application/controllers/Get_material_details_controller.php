<?php
//this is the controller for the API that gets the details of a material
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_material_details_controller extends CI_Controller
{
	public function index ()
	{

		//session start to access session variables
		session_start();

		//checks if the type array key exists in session
		if(array_key_exists("type",$_SESSION)){

			//if the user in session is a superadmin, admin, or technician
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")){

				//checks if materialID array key exists in post
        if(array_key_exists("materialID",$_POST)){

					//loads codeigniter database module
          $this->load->database();

					//queries the database
  				$rows = $this->db->query("SELECT materialName, materialCost, materialUnitMeasurement, materialDescription FROM materials WHERE materialID=".$_POST["materialID"]."")->result_array();

					//sends a JSON object containing the material details
  		    if(count($rows)==1){
            echo (json_encode(
	                  array(
	                    'materialName'=>$rows[0]["materialName"],
	                    'materialCost'=>$rows[0]["materialCost"],
	                    'materialUnitMeasurement'=>$rows[0]["materialUnitMeasurement"],
	                    'materialDescription'=>$rows[0]["materialDescription"]
	                  )
								 ));
          }

					//preterminates the execution of the script
  				return;
        }
			}
		}
	}
}
?>
