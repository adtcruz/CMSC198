<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Announcements_model extends CI_Model
{
    public function __construct ()
    {
        parent::__construct ();
        $this->load->database ();
    }

    public function getAnnouncements ()
    {
        $query = $this->db->query ('SELECT announcements.announcementText AS details, announcements.announcementTitle AS title, announcements.dateCreated FROM annoucements ORDER BY announcements.dateCreated DESC');
        $db_data['announcements'] = $query->result_array();
        return $db_data;
    }

    public function getDashAnnouncements ()
    {
        
    }

    public function addAnnouncement ($db_data)
    {
        // extract user ID using user type and username
        echo $db_data['createdBy'];
    }
}
?>
