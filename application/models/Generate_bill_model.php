<?php

class Generate_bill_model extends CI_Model
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
		$query = $this->db->query ('SELECT job.jobID, client.givenName, client.lastName FROM client, job WHERE job.jobStatus=\'PROCESSED\' AND job.clientID = client.clientID');
		$db_data['generateBill_array'] = $query->result_array ();
		return $db_data;
	}
}
?>
