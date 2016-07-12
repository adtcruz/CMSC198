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
        $query = $this->db->query ('SELECT announcements.announcementText AS details, announcements.announcementTitle AS title, announcements.dateCreated FROM announcements ORDER BY announcements.dateCreated DESC');
        $db_data['announcements'] = $query->result_array();
        return $db_data;
    }

    public function getDashAnnouncements ()
    {
        $query = $this->db->query ('SELECT announcements.announcementText AS details, announcements.announcementTitle AS title, announcements.dateCreated FROM announcements ORDER BY announcements.dateCreated DESC LIMIT 3');
        $db_data['announcements'] = $query->result_array();
        return $db_data;
    }

    public function addAnnouncement ($db_data)
    {
        //echo $db_data['createdBy'];
        // extract user ID using user type and username
        switch ($db_data['createdByType'])
        {
            case 'admin':
            case 'technician':
                $query = $this->db->query ('SELECT adminAcc.adminID FROM adminAcc WHERE adminAcc.username = "'.$db_data['createdBy'].'"');
                $createdBy = $query->result_array ()[0]['adminID'];
            break;
            case 'superadmin':
                $query = $this->db->query ('SELECT superAdmin.superAdminID AS adminID FROM superAdmin WHERE superAdmin.username = "'.$db_data['createdBy'].'"');
                $createdBy = $query->result_array ()[0]['adminID'];
            break;
        }
        echo $db_data['createdBy'];
        echo $createdBy;
        echo $db_data['title'];
        echo $db_data['text'];
    }
}
?>
