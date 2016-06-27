<?php

class Submit_job_request_model extends CI_Model
{
	// constructor
	public function __construct ()
	{
		parent::__construct ();
		// connect to database
		$this->load->database ();
	}

	public function getClientQueryRows($username){
		return $this->db->query(
			"SELECT clientID FROM client WHERE username='".$username."'"
		);
	}

	public function submitJobRequest($jobDescription,$username,$clientID,$createdBy,$createdByType,$extension){
		$this->db->query(
			"INSERT INTO job (jobDescription, startDate, clientID, createdBy, createdByType, dateCreated)".
			"VALUES ('".$jobDescription."',NULL,".$clientID.",".$createdBy.",'".$createdByType."', CURDATE())"
		);
		//log this action
		$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES('".$username." filed a job request".$extension."',CURRENT_TIMESTAMP)");

	}

	public function getAdminID($username){

		$query = $this->db->query("SELECT adminID FROM adminAcc WHERE username='".$username."'");

		$rows = $query->result_array();

		if(count($rows) == 1){
			return $rows[0]["adminID"];
		}
	}

	public function getSuperAdminID($username){

		$query = $this->db->query("SELECT superAdminID FROM superAdmin WHERE username='".$username."'");

		$rows = $query->result_array();

		if(count($rows) == 1){
			return $rows[0]["superAdminID"];
		}
	}
}
?>
