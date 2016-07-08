<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_work_details_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

        if(array_key_exists("workID",$_POST)){

          $this->load->database();

  				$rows = $this->db->query("SELECT workDescription, workCost FROM work WHERE workID=".$_POST["workID"]."")->result_array();

  		    if(count($rows)==1){
            echo (json_encode(
	                  array(
	                    'workDescription'=>$rows[0]["workDescription"],
	                    'workCost'=>$rows[0]["workCost"]
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
