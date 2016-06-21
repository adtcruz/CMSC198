<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_office_list extends CI_Controller
{
	public function index ()
	{
		$this->load->database();
		session_start();
		if(array_key_exists("type",$_SESSION)){
			if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){
				$query = $this->db->query("SELECT officeAbbr, officeName FROM office");
				$rows = $query->result_array();
				$rowsN = count($rows);
				
				for($i = 0; $i < $rowsN; $i++){
					echo "<option value=\"".$rows[$i]["officeAbbr"]."\">".$rows[$i]["officeName"]."</option>";
				}
			}
			else {
				echo "Not allowed for this account";
			}
		}
		
	}
}
?>