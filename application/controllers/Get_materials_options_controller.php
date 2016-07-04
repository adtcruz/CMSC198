<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_materials_options_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				$this->load->database();

				$rows = $this->db->query("SELECT materialID, materialName FROM materials WHERE active=1")->result_array();

		    $options = "<option value=\"\" selected=\"selected\" disabled=\"disabled\">Select material…</option>";

				foreach($rows as $row){
		      $options = $options . "<option value='".$row["materialID"]."'>".$row["materialName"]."</option>";
		    }

				echo $options;
			}
		}
	}
}
?>
