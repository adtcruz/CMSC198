<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Get_date_controller extends CI_Controller
    {
        public function index ()
        {
            // laod database
            $this->load->database ();
            // get earliest date (a.k.a mindate) in the database
            $query = $this->db->query ('SELECT job.dateCreated FROM job ORDER BY job.dateCreated ASC LIMIT 1');
            $row = $query->result_array ();
            $db_data['minDate'] = $row[0]['dateCreated'];
            // this is for the latest date (a.k.a maxdate)
            // the same flow as in minDate
            $query = $this->db->query ('SELECT job.dateCreated FROM job ORDER BY job.dateCreated DESC LIMIT 1');
            $row = $query->result_array ();
            $db_data['maxDate'] = $row[0]['dateCreated'];
            // create array for json to encode
            $array = array ('maxDate' => $db_data['maxDate'], 'minDate' => $db_data['minDate']);
            // encode array as json object
            echo json_encode ($array);
            return;
        }
    }
?>
