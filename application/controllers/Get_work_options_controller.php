<?php
//this is the controller for the API that gets the allowable work options
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_work_options_controller extends CI_Controller
{
	public function index ()
	{

		//session start to access session variables
		session_start();

		//checks if type array key exists in session
		//if it does it means that there is a user in session
		if(array_key_exists("type",$_SESSION)){

			//if the user in session is a technician or superadmin
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				//loads code igniter database module
				$this->load->database();

				//queries the database
				$rows = $this->db->query("SELECT workID, workDescription FROM work WHERE active=1")->result_array();

				//inserts a filler option
		    $options = "<option value=\"\" selected=\"selected\" disabled=\"disabled\">Select work…</option>";

				foreach($rows as $row){
		      $options = $options . "<option value='".$row["workID"]."'>".$row["workDescription"]."</option>";
		    }

				//returns the options
				echo $options;
			}
		}
	}
}
?>
