<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart_model extends CI_Model
{
    public function __construct ()
    {
        parent::__construct ();
        $this->load->database ();
    }

    // this function will get the count of jobStatus in the job table. refer to the label in the $db_data variable
    public function getTotalJobStatus ()
    {
        $query = $this->db->query ('SELECT COUNT(job.jobStatus) AS count FROM job WHERE (job.jobStatus = "PENDING")');
        $db_data['pending'] = $query->result_array ()[0]['count'];

        $query = $this->db->query ('SELECT COUNT(job.jobStatus) AS count FROM job WHERE (job.jobStatus = "PROCESSING")');
        $db_data['processing'] = $query->result_array ()[0]['count'];

        $query = $this->db->query ('SELECT COUNT(job.jobStatus) AS count FROM job WHERE (job.jobStatus = "PROCESSED")');
        $db_data['processed'] = $query->result_array ()[0]['count'];

        $query = $this->db->query ('SELECT COUNT(job.jobStatus) AS count FROM job WHERE (job.jobStatus = "CANCELED")');
        $db_data['canceled'] = $query->result_array ()[0]['count'];

        return $db_data;
    }

    public function getWorkServiced ()
    {
        $query = $this->db->query ('SELECT work.workDescription FROM work');
        $values = array ();
        $this->table->clear ();
        foreach ($query->result_array () as $row)
        {
            $query2 = $this->db->query ('SELECT COUNT(workDone.workID) AS count FROM workDone, work WHERE (workDone.workID = work.workID) AND (work.workDescription = "'.$row['workDescription'].'")');
            $count = $query2->result_array ()[0]['count'];
            array_push ($values, array ($row['workDescription'], $count));
            $this->table->add_row ($row['workDescription'], $count);
        }
        $db_data['values'] = $values;
        return $db_data;
    }

    public function getMonthlyIncome ()
    {
        for ($i = 1; $i < 12; $i++)
        {
            $query = $this->db->query ('SELECT * FROM job');
        }
    }


}
?>
