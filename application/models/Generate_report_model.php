<?php
/*
* file: GenerateReport_model.php
*   This model will retrieve the data to generate a report.
*   It will be returned to a view that will process said data into a PDF document.
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate_report_model extends CI_Model
{
	public $db_data;

	public function __construct ()
	{
		parent::__construct ();
		$this->load->database ();
	}

	// generates total work income in a conveniently placed table
	public function totalWorkIncome ($date)
	{
        $this->table->clear ();
        $this->table->set_heading ('Service Name', 'Income');
        // total income between said dates
        $workList = $this->db->query ('SELECT workID, workCost, workName FROM work')->result_array ();
        $workDone = $this->db->query ('SELECT workID, workDuration FROM workDone')->result_array ();
        $total = 0;
        foreach ($workList as $row)
        {
            $cost = 0;
            foreach ($workDone as $row2)
            {
                if ($row['workID'] = $row2['workID'])
                {
                    $cost += ($row['workCost']*$row2['workDuration']);
                }
            }
            $total += $cost;
            $this->table->add_row ($workList['workName'], $cost);
        }
        $this->table->add_row ('Total Income', $total);
        $db_data['totalWorkIncome'] = $this->table->generate ();
        return $db_data;
	}

    public function totalNumberOfJobs ($date)
    {
        // for pending
        $pending = $this->db->query ('SELECT COUNT(*) AS count FROM job WHERE (job.dateCreated BETWEEN DATE('.$date['date1'].') AND DATE('.$date['date2'].')) AND (job.finishDate IS NULL)')->result_array ()[0]['count'];

        // for processing
        $processing = $this->db->query ('SELECT COUNT(*) AS count FROM job WHERE (job.dateCreated BETWEEN DATE('.$date['date1'].') AND DATE('.$date['date2'].')) AND (job.startDate IS NOT NULL) AND (job.finishDate IS NULL)')->result_array ()[0]['count'];

        // for processed
        $processed = $this->db->query ('SELECT COUNT(*) AS count FROM job WHERE (job.dateCreated BETWEEN DATE('.$date['date1'].') AND DATE('.$date['date2'].')) AND (job.startDate IS NOT NULL) AND (job.finishDate IS NOT NULL)');

        // pass to array
        $db_data['pending'] = $pending;
        $db_data['processing'] = $processing;
        $db_data['processed'] = $processed;

        return $db_data;
    }

    public function 
}
?>
