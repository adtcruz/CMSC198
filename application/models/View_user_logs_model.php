<?php

class View_user_logs_model extends CI_Model
{

	public function __construct ()
	{
		parent::__construct ();
		$this->load->database();
	}

	public function processLogsTable($rows){

		$logTable = "";

		if(count($rows)>0){

			$this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));

			$this->table->set_heading("Log Entry","Timestamp");

			for($i = 0; $i < count($rows); $i++){

				$this->table->add_row($rows[$i]["logText"],$rows[$i]["logTimestamp"]);
			}

			$logTable = $this->table->generate();
		}

		else $logTable = "No log entries";

		return $logTable;
	}

  public function getLogEntries(){

		$query = $this->db->query(
			"SELECT logText, logTimestamp FROM userLogs ORDER BY logTimestamp DESC"
		);

		$row = $query->result_array();

		$logTable = $this->processLogsTable($row);

		return $logTable;
	}

	public function getLogInEntries(){
		$query = $this->db->query(
			"SELECT logText, logTimestamp FROM userLogs WHERE logText LIKE '%logged-on' ORDER BY logTimestamp DESC"
		);

		$row = $query->result_array();

		$logTable = $this->processLogsTable($row);

		return $logTable;
	}

	public function getLogOutEntries(){
		$query = $this->db->query(
			"SELECT logText, logTimestamp FROM userLogs WHERE logText LIKE '%logged-out' ORDER BY logTimestamp DESC"
		);

		$row = $query->result_array();

		$logTable = $this->processLogsTable($row);

		return $logTable;
	}

	public function getJobActionsEntries(){
		$query = $this->db->query(
			"SELECT logText, logTimestamp FROM userLogs WHERE logText LIKE '%scheduled%' OR logText LIKE '%filed%' OR logText LIKE '%canceled%' OR logText LIKE '%marked%'ORDER BY logTimestamp DESC"
		);

		$row = $query->result_array();

		$logTable = $this->processLogsTable($row);

		return $logTable;
	}

	public function getUserEntries($username){
		$query = $this->db->query(
			"SELECT logText, logTimestamp FROM userLogs WHERE logText LIKE '".$username."%' ORDER BY logTimestamp DESC"
		);

		$row = $query->result_array();

		$logTable = $this->processLogsTable($row);
		return $logTable;
	}

	public function getUsersEntries($username){

		$query = $this->db->query("SELECT username FROM superAdmin WHERE username='".$username."'");

		//username was found and it's a superAdmin
		if(count($query->result_array())==1){
			return $this->getUserEntries($username);
		}

		$query = $this->db->query("SELECT username FROM adminAcc WHERE username='".$username."'");

		//username was found and it's either an admin or technician
		if(count($query->result_array())==1){
			return $this->getUserEntries($username);
		}

		$query = $this->db->query("SELECT username FROM client WHERE username='".$username."'");

		//username was found and it's either an admin or technician
		if(count($query->result_array())==1){
			return $this->getUserEntries($username);
		}
		else return "Username not found";
	}
}
?>
