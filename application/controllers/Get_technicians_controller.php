<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_technicians_controller extends CI_Controller
{
	public function index ()
	{
		session_start();
		if(array_key_exists("type",$_SESSION)){
			if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){

				//loads Code Igniter database module
				$this->load->database();

				//queries the database for officeIDs and officeNames
				$query = $this->db->query("SELECT adminID, givenName, lastName FROM adminAcc WHERE isTechnician=1");

				//gets the results in easy-to-use array form
				$rows = $query->result_array();
				//gets the number of rows
				$rowsN = count($rows);

				if ($rowsN === 0) echo "No clients";
				else {
					$technicians = "<option value=\"\" selected=\"selected\" disabled=\"disabled\">Select name…</option>";

					for($i = 0; $i < $rowsN; $i++){
						$technicians = $technicians."<option value=\"".$rows[$i]["adminID"]."\">".$rows[$i]["givenName"]." ".$rows[$i]["lastName"]."</option>";
					}
					echo $technicians;
				}
			}
		}
		else {
			die("You are not logged-in");
		}
	}
}
?>
