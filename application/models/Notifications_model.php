<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Notification_model extends CI_Model
    {
        public function __construct ()
        {
            parent::__construct ();
            $this->load->database ();
        }

        public function getData ($jobID)
        {
            $query = $this->db->query ('SELECT client.clientID')
        }

        public function insertNotification ()
        {

        }

        public function getUnread ()
        {

        }
    }

?>
