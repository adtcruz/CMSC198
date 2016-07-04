<?php
/*
* file: Bill_for_payment_model.php
*   This model handles all the data needed to generate the PDF of the bill for payment.
*/
// deny direct access
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// class declarations
class Bill_for_payment_model extends CI_Model
{
	// data container
	public $db_data;
	// class constructor
	public function __construct ()
	{
        // call to parent constructor
        parent::__construct ();
		// connect to database
		$this->load->database ();
	}
	// this function will return the needed data
	public function getData ($jobID)
	{
		// grabs the job id argument
		$db_data['jobID'] = $jobID;
		// returns the current head of ITC
		$query = $this->db->query ('SELECT head FROM office WHERE officeAbbr = \'ITC\'');
		$rows = $query->result_array ();
		$db_data['head'] = $rows[0]['head'];
		/* returns the information of the finished job namely
			client's name, client's unit/office, office's full name that serves as the location, and the job description
		*/
		$query = $this->db->query ('SELECT client.givenName, client.lastName, office.officeAbbr, office.officeName, job.jobDescription FROM client, office, job WHERE job.jobID = '.$jobID.' AND job.clientID = client.clientID AND client.officeID = office.officeID');
		$rows = $query->result_array ();
		$db_data['givenName'] = $rows[0]['givenName'];
		$db_data['lastName'] = $rows[0]['lastName'];
		$db_data['officeAbbr'] = $rows[0]['officeAbbr'];
		$db_data['officeName'] = $rows[0]['officeName'];
		$db_data['jobDescription'] = $rows[0]['jobDescription'];

        // computes the total cost
        // get total cost of all materials
        $query = $this->db->query ('SELECT (materialsUsed.materialUnits*materials.materialCost) AS totalCost FROM materialsUsed, materials WHERE (materialsUsed.jobID = '.$jobID.') AND (materialsUsed.materialID = materials.materialID)');
        $db_data['materialTotalCost'] = $query->result_array();

        // get total cost of all work done
        $query = $this->db->query ('SELECT (workDone.workDuration*work.workCost) AS totalCost FROM work, workDone WHERE (workDone.jobID = '.$jobID.') AND (workDone.workID = work.workID)');
        $db_data['workTotalCost'] = $query->result_array ();

        $db_data['totalCost'] = 0;

        foreach ($db_data['materialTotalCost'] as $row)
        {
            $db_data['totalCost'] += $row['totalCost'];
        }

        foreach ($db_data['workTotalCost'] as $row)
        {
            $db_data['totalCost'] += $row['totalCost'];
        }

        /*
        // get total cost of all materials
        $query = $this->db->query ('SELECT materials.materialName, materials.materialCost, materialsUsed.materialUnits, (materials.materialCost*materialsUsed.materialUnits) AS totalCost FROM materials, materialsUsed, job WHERE (materialsUsed.jobID = '.$jobID.') AND (materialsUsed.materialID = materials.materialID)');
		$db_data['materialsUsed'] = $query->result_array ();

        // get total cost of all work done
        $query = $this->db->query ('SELECT work.workDescription, work.workCost, workDone.workDuration, (work.workCost*workDone.workDuration) AS totalCost FROM work, workDone, job WHERE (workDone.jobID = '.$jobID.') AND (workDone.workID = work.workID)');
        $db_data['workDetails'] = $query->result_array ();
        */

		return $db_data;
	}
}
?>
