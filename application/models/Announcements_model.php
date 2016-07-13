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
        $query = $this->db->query ('SELECT announcements.announcementID AS ID, announcements.announcementText AS details, announcements.announcementTitle AS title, announcements.dateCreated FROM announcements ORDER BY announcements.announcementID DESC');
        $db_data['announcements'] = $query->result_array();
        return $db_data;
    }

    public function getDashAnnouncements ()
    {
        $query = $this->db->query ('SELECT announcements.announcementText AS details, announcements.announcementTitle AS title, announcements.dateCreated FROM announcements ORDER BY announcements.announcementID DESC LIMIT 3');
        $db_data['announcements'] = $query->result_array();
        return $db_data;
    }

    public function addAnnouncement ($db_data)
    {
        //echo $db_data['createdBy'];
        // extract user ID using user type and username
        $createdBy = '';
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

        $title = $db_data['title'];
        $text = $db_data['text'];
        $createdByType = $db_data['createdByType'];

        $query = $this->db->query ('INSERT INTO announcements (announcementText, announcementTitle, dateCreated, createdBy, createdByType) VALUES ("'.$text.'", "'.$title.'", CURDATE(), '.$createdBy.', "'.$createdByType.'")');
        return ($this->db->affected_rows () != 1) ? FALSE : TRUE;
    }
}
?>
