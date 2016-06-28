<?php

class Manage_application_model extends CI_Model
{

	public function __construct ()
	{
		parent::__construct ();
		$this->load->database();
	}

  public function getTopFiveLogEntries(){
		$query = $this->db->query(
			"SELECT logText FROM userLogs ORDER BY logTimestamp DESC LIMIT 5"
		);
		$row = $query->result_array();
		$logList = "";
		if(count($row)>0){

			for ($i = 0; $i <count($row); $i++){
			 $logList = $logList . "<li>".$row[$i]["logText"]."</li>";
			}
		}
		else $logList = "<li>Sorry, there are no recent log entries</li>";
		return $logList;
	}

	public function getNumberOfAdminAccounts(){
		$query = $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE isTechnician=0");
		$row = $query->row_array();
		return $row["COUNT(adminID)"];
	}

	public function getNumberOfTechnicianAccounts(){
		$query = $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE isTechnician=1");
		$row = $query->row_array();
		return $row["COUNT(adminID)"];
	}

	public function getNumberOfClientAccounts(){
		$query = $this->db->query("SELECT COUNT(clientID) FROM client");
		$row = $query->row_array();
		return $row["COUNT(clientID)"];
	}

	public function getNumberOfSuperadminAccounts(){
		$query = $this->db->query("SELECT COUNT(superAdminID) FROM superAdmin");
		$row = $query->row_array();
		return $row["COUNT(superAdminID)"];
	}
}
?>
