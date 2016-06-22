<?php

class Schedule_model extends CI_Model
{
	// constructor
	public function __construct ()
	{
		parent::__construct ();
		// connect to database
		$this->load->database ();
	}

	public function getData ()
	{
		$query = $this->db->query ('SELECT schedule.priority, job.jobDescription, office.officeName, schedule.dateCreated, schedule.dateScheduled, client.givenName, client.lastName FROM client, schedule, job, office WHERE schedule.jobID = job.jobID AND job.clientID = client.clientID AND schedule.dateCreated = job.dateCreated AND client.officeID = office.officeID');
		$db_data['schedule_array'] = $query->result_array ();
		return $db_data;
	}
}
?>