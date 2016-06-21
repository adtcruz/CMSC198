<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_office_list extends CI_Controller
{
	public function index ()
	{
		session_start();
		if(array_key_exists("type",$_SESSION)){
			if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){
				//loads Code Igniter database module
				$this->load->database();
				
				//queries the database for officeIDs and officeNames
				$query = $this->db->query("SELECT officeID, officeName FROM office");
				
				//gets the results in easy-to-use array form
				$rows = $query->result_array();
				//gets the number of rows
				$rowsN = count($rows);
				
				$options = "<option value=\"\" selected=\"selected\">Select office</option>";
				
				for($i = 0; $i < $rowsN; $i++){
					$options = $options."<option value=\"".$rows[$i]["officeID"]."\">".$rows[$i]["officeName"]."</option>";
				}
				echo $options;
			}
			else {
				echo "Not allowed for this account";
			}
		}
		else {
			echo "Not allowed";
		}
	}
}
?>