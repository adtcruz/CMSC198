<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Job_request_form_model extends CI_Model
{
	public $db_data;

	public function __construct ()
	{
		parent::__construct ();
		$this->load->database ();
	}

	public function getData ($jobID)
	{
		session_start();
        $query = $this->db->query ('SELECT client.givenName, client.lastName, client.designation, office.officeAbbr, office.officeName, office.telephoneNumber, job.jobDescription FROM client, job, office WHERE (job.jobID = '.$jobID.') AND (job.clientID = client.clientID) AND (client.officeID = office.officeID)');
        $result = $query->result_array ();

        $db_data['name'] = $result[0]['givenName'].' '.$result[0]['lastName'];
        $db_data['designation'] = $result[0]['designation'];
        $db_data['officeAbbr'] = $result[0]['officeAbbr'];
        $db_data['officeName'] = $result[0]['officeName'];
        $db_data['telNo'] = $result[0]['telephoneNumber'];
        $db_data['problem'] = $result[0]['jobDescription'];

        $query = $this->db->query ('SELECT work.workDescription AS description, work.workCost AS rate, workDone.workDuration AS duration FROM work, workDone WHERE (workDone.jobID = '.$jobID.') AND (workDone.workID = work.workID)');
        $db_data['workDone'] = $query->result_array ();

        $query = $this->db->query ('SELECT materials.materialName AS description, materials.materialCost AS cost, materialsUsed.materialUnits AS units FROM materials, materialsUsed WHERE (materialsUsed.jobID = '.$jobID.') AND (materialsUsed.materialID = materials.materialID)');
        $db_data['materialsUsed'] = $query->result_array ();

		return $db_data;
	}
}
?>
