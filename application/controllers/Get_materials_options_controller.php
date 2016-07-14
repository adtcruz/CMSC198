<?php
//this is the controller for the API that gets the materials options for select
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_materials_options_controller extends CI_Controller
{
	public function index ()
	{

		//session start to access session variables
		session_start();

		//checks if type array key exists in session
		//if it does it means that there is a user in session
		if(array_key_exists("type",$_SESSION)){

			//checks if the user in session is either superadmin or technician
			//since only superadmins and technicians can add materials used in a job request,
			//only superadmins and technicians may see the options
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				//loads the codeigniter database module
				$this->load->database();

				//queries the database for visible materials
				$rows = $this->db->query("SELECT materialID, materialName FROM materials WHERE active=1")->result_array();

				//adds a filler option
		    $options = "<option value=\"\" selected=\"selected\" disabled=\"disabled\">Select material…</option>";

				//creates options
				foreach($rows as $row){
		      $options = $options . "<option value='".$row["materialID"]."'>".$row["materialName"]."</option>";
		    }

				//returns the options
				echo $options;
			}
		}
	}
}
?>
