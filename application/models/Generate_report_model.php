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
        $this->table->set_template (array ('table_open' => '<table class = "bordered striped">'));
        $this->table->set_heading ('Service Name', 'Income');
        // total income between said dates
        $workList = $this->db->query ('SELECT workID, workCost, workDescription FROM work')->result_array ();
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
            if ($cost != 0)
            {
                $this->table->add_row ($row['workDescription'], $cost);
            }
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
        $processed = $this->db->query ('SELECT COUNT(*) AS count FROM job WHERE (job.dateCreated BETWEEN DATE('.$date['date1'].') AND DATE('.$date['date2'].')) AND (job.startDate IS NOT NULL) AND (job.finishDate IS NOT NULL)')->result_array ()[0]['count'];

        $this->table->clear ();
        $this->table->set_template (array ('table_open' => '<table class = "centered">'));
        $this->table->set_heading ('Total Pending', 'Total Processing', 'Total Processed');
        $this->table->add_row ($pending, $processing, $processed);
        $db_data['totalNumberOfJobs'] = $this->table->generate ();
        return $db_data;
    }

    public function totalJobsByOffice ($date)
    {
        $officeList = $this->db->query ('SELECT officeID FROM office')->result_array ();
        $maxCount = 0;
        $this->table->clear ();
        $this->table->set_heading ('Office', 'Request Count');
        foreach ($officeList as $row)
        {
            $result = $this->db->query ('SELECT COUNT(*) AS count, office.officeName FROM job, office, client WHERE (job.clientID = client.clientID) AND (client.officeID = office.officeID) AND (office.officeID = '.$row['officeID'].') AND (job.dateCreated BETWEEN (DATE('.$date['date1'].')) AND DATE('.$date['date2'].'))')->result_array ();
            if ($result[0]['count'] > $maxCount)
            {
                $maxCount = $result[0]['count'];
                $maxOfficeName = $result[0]['officeName'];
            }
            if ($result[0]['count'] != 0)
            {
                $this->table->add_row ($result[0]['officeName'], $result[0]['count']);
            }
        }

        $db_data['totalJobsByOffice'] = $this->table->generate ();
        $this->table->clear ();

        $this->table->set_heading ('Office with Highest Request', 'Request Count');
        $this->table->add_row ($maxOfficeName, $maxCount);
        $db_data['maxOffice'] = $this->table->generate ();

        return $db_data;
    }

    public function totalMaterialsUsed ($date)
    {
        $this->table->clear ();
        $this->table->set_heading ('Material Name', 'Material Count', 'Material Cost');

        $materials = $this->db->query ('SELECT materialID, materialName, materialCost FROM materials')->result_array ();
        $materialCounts = $this->db->query ('SELECT materialID, materialUnits FROM materialsUsed WHERE (dateCreated BETWEEN DATE('.$date['date1'].') AND DATE('.$date['date2'].'))')->result_array ();
        $total = 0;
        foreach ($materials as $row)
        {
            $count = 0;
            $cost = 0;
            foreach ($materialCounts as $row2)
            {
                if ($row['materialID'] == $row2['materialID'])
                {
                    $count += $row2['materialUnits'];
                    $cost += $row['materialCost'];
                }
            }
            if ($count != 0)
            {
                $this->table->add_row ($row['materialName'], $count, $cost);
                $total += $cost;
            }
        }
        $this->table->add_row (array ('data' => 'Total Income from Materials Used', 'colspan' => '2'), $total);

        $db_data['totalMaterialsUsed'] = $this->table->generate ();
        return $db_data;
    }
}
?>
