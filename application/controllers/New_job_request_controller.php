<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_job_request_controller extends CI_Controller
{
	public function index ()
	{
		session_start();
		if(array_key_exists("type",$_SESSION)){
			$options = "";
			if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){
				//loads Code Igniter database module
				$this->load->database();

				//queries the database for officeIDs and officeNames
				$query = $this->db->query("SELECT officeID, officeName FROM office ORDER BY officeName");

				//gets the results in easy-to-use array form
				$rows = $query->result_array();
				//gets the number of rows
				$rowsN = count($rows);

				$options = "<option value=\"\" selected=\"selected\" disabled=\"disabled\">Select office…</option>";

				for($i = 0; $i < $rowsN; $i++){
					$options = $options."<option value=\"".$rows[$i]["officeID"]."\">".$rows[$i]["officeName"]."</option>";
				}
			}
			$this->load->view('New_job_request_view', array('options'=>$options));
		}
		else {
			die("You are not logged-in");
		}
	}
}
?>
