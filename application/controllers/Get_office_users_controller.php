<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_office_users_controller extends CI_Controller
{
	public function index ()
	{
		session_start();
		if(array_key_exists("type",$_SESSION)){
			if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){

				//checks if officeID array key exists in post
				if(array_key_exists("officeID",$_POST)){

					//loads Code Igniter database module
					$this->load->database();

					//queries the database for officeIDs and officeNames
					$query = $this->db->query("SELECT username, givenName, lastName FROM client WHERE officeID=".$_POST["officeID"]);

					//gets the results in easy-to-use array form
					$rows = $query->result_array();
					//gets the number of rows
					$rowsN = count($rows);

					if ($rowsN === 0) echo "No clients";
					else {
						$clients = "<option value=\"\" selected=\"selected\" disabled=\"disabled\">Select name…</option>";

						for($i = 0; $i < $rowsN; $i++){
							$clients = $clients."<option value=\"".$rows[$i]["username"]."\">".$rows[$i]["givenName"]." ".$rows[$i]["lastName"]."</option>";
						}
						echo $clients;
					}
				}
			}
		}
		else {
			die("You are not logged-in");
		}
	}
}
?>
