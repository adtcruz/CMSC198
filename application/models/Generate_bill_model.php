<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Generate_bill_model extends CI_Model
{
	// constructor
	public function __construct ()
	{
		parent::__construct ();
		// connect to database
		$this->load->database ();
	}

	public function getData ($username)
	{
    $query = $this->db->query ('SELECT client.clientID FROM client WHERE (client.username = "'.$username.'")');
    $clientID = $query->result_array ()[0]['clientID'];
    $query = $this->db->query ('SELECT job.jobID, client.givenName, client.lastName FROM client, job WHERE (job.jobStatus=\'PROCESSED\') AND (job.clientID = '.$clientID.') AND  (job.clientID = client.clientID)');
		$db_data['generateBill_array'] = $query->result_array ();
		return $db_data;
	}
}
?>
