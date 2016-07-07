<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_material_details_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

        if(array_key_exists("materialID",$_POST)){

          $this->load->database();

  				$rows = $this->db->query("SELECT materialName, materialCost, materialUnitMeasurement, materialDescription FROM materials WHERE materialID=".$_POST["materialID"]."")->result_array();

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

  				return;
        }
			}
		}
	}
}
?>
