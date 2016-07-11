<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_dash_model extends CI_Model
{
    public function __construct ()
    {
        parent::__construct ();
        $this->load->database ();
    }

    public function getClientData ($username)
    {
        // extract clientID using session username
        $query = $this->db->query ('SELECT client.clientID FROM client WHERE client.username = "'.$username.'"');
        $clientID = $query->result_array ()[0]['clientID'];

        // get 5 most recent job requests
        $query = $this->db->query ('SELECT job.jobDescription AS description, job.jobStatus AS status, job.dateCreated FROM job, client WHERE (client.clientID = '.$clientID.') AND (job.clientID = client.clientID) ORDER BY job.dateCreated ASC LIMIT 5');
        $db_data['latestJobs'] = $query->result_array ();
        
        // get some rates
        $query = $this->db->query ('SELECT work.workDescription AS serviceName, work.workCost AS serviceRate FROM work LIMIT 5');
        $db_data['services'] = $query->result_array ();

        return $db_data;
    }

    public function getAdminData ()
    {

    }
}
?>
