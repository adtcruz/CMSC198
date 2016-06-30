<?php

class View_schedule_model extends CI_Model
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
		$query = $this->db->query ('SELECT schedule.priority, job.jobDescription, office.officeName, schedule.dateCreated, schedule.dateScheduled, client.givenName, client.lastName FROM client, schedule, job, office WHERE schedule.jobID = job.jobID AND job.clientID = client.clientID AND client.officeID = office.officeID ORDER BY schedule.dateScheduled');
		return $query->result_array ();
	}

	public function processScheduleTable(){

		$schedule_array = $this->getData();

		$this->table->set_template(array('table_open' => '<table class="bordered centered highlight">'));
		$this->table->set_heading('Priority','Scheduled Date','Job Description','Client Name','Location','Action');

		if(count($schedule_array) == 0){
			return "<h5 class=\"center-align\">Sorry, there are no scheduled job requests at the moment.</h5>";
		}

		foreach ($schedule_array as $row){
			if($row['priority']==1) $priority = "Normal";
			if($row['priority']==2) $priority = "Urgent";
			if($row['priority']==3) $priority = "Very Urgent";
			$this->table->add_row ($priority, $row['dateScheduled'], $row['jobDescription'], $row['givenName'].' '.$row['lastName'], $row['officeName'],"");
		}

		return $this->table->generate ();

	}
}
?>
