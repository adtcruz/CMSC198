<?php
/*
* file: GenerateReport_model.php
*   This model will retrieve the data to generate a report.
*   It will be returned to a view that will process said data into a PDF document.
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GenerateReport_model extends CI_Model
{
	public $db_data;

	public function __construct ()
	{
		parent::__construct ();
		$this->load->database ();
	}

	// generates a report of all job requests. the interval depends on the argument supplied
	public function generateReport ($date)
	{
		$query = $this->db->query ('SELECT job.jobDescription, job.dateCreated, job.finishDate, office.officeAbbr FROM client, job, office WHERE (job.dateCreated BETWEEN '.$date['date1'].' AND '.$date['date2'].') AND (job.clientID = client.clientID) AND (client.officeID = office.officeID) ORDER BY job.dateCreated ASC');
		$db_data['result_array'] = $query->result_array ();

		$query = $this->db->query ('SELECT COUNT(office.officeAbbr) AS count, office.officeAbbr FROM job, office, client WHERE (job.clientID = client.clientID) AND (client.officeID = office.officeID) AND (job.dateCreated BETWEEN '.$date['date1'].' AND '.$date['date2'].') GROUP BY office.officeAbbr LIMIT 1');
		$row = $query->result_array ();

		$db_data['officeCount'] = $row[0]['count'];
		$db_data['officeHighest'] = $row[0]['officeAbbr'];

        return $db_data;
	}
}
?>
