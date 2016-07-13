<?php
//this is the controller for the API that gets the details of a work
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_work_details_controller extends CI_Controller
{
	public function index ()
	{

		//session start to access session variables
		session_start();

		//checks if the type array key exists in session
		if(array_key_exists("type",$_SESSION)){

			//if the user in session is a superadmin, admin, or technician
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")){

				//checks if workID array key exists in post
        if(array_key_exists("workID",$_POST)){

					//loads codeigniter database module
          $this->load->database();

					//queries the database
  				$rows = $this->db->query("SELECT workDescription, workCost FROM work WHERE workID=".$_POST["workID"]."")->result_array();

					//sends a JSON object containing the work details
  		    if(count($rows)==1){
            echo (json_encode(
	                  array(
	                    'workDescription'=>$rows[0]["workDescription"],
	                    'workCost'=>$rows[0]["workCost"]
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
