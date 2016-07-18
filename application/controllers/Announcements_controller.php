<?php
/*
*   file: Announcements_controller.php
*       this file serves as the main controller for all announcements related tasks
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Announcements_controller extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();
        $this->load->model ('Announcements_model', 'am');
        $this->load->model ('Notifications_model', 'nm');
        $this->load->helper ('form');
        $this->load->library ('form_validation');
        session_start();
    }

    public function index ()
    {
        if (array_key_exists ('type', $_SESSION))
        {
            switch ($_SESSION['type'])
            {
                case 'client':
                    $db_data['announcements'] = $this->am->getAnnouncements ();
                    $db_data['unread'] = $this->nm->getClientNotifs($_SESSION['username']);
                    $this->load->view ('Announcements_client_view', $db_data);
                break;
                case 'admin':
                case 'technician':
                case 'superadmin':

                    $this->form_validation->set_rules ('title', 'Title', 'trim|required|min_length[10]', array(
                        'required' => 'Title is required', 'min_length' => 'Title is too short'
                    ));
                    $this->form_validation->set_rules ('content', 'Content', 'trim|required|min_length[10]', array(
                        'required' => 'Text is required', 'min_length' => 'Content is too short'
                    ));

                    if ($this->form_validation->run() == FALSE)
                    {
                        $db_data['announcements'] = $this->am->getAnnouncements ();
                        $db_data['unread'] = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
                        $this->load->view ('Announcements_admin_view', $db_data);
                    }
                    else
                    {
                        // target toggle modal or something
                        $this->addAnnouncements ();
                        $db_data = $this->am->getAnnouncements ();
                        $this->load->view ('Announcements_admin_view', $db_data);
                    }
                break;
                default: // redirect
            }
        }
    }

    public function deleteAnnouncement ()
    {
        if (array_key_exists ("type", $_SESSION))
        {
            if ($_SESSION['type'] != 'client')
            {
                if (array_key_exists ("announcementID", $_POST))
                {
                    $this->load->database ();
                    $this->db->query ('DELETE FROM announcements WHERE announcementID = '.$_POST['announcementID'].'');
                    if ($this->db->affected_rows () == 1)
                    {
                        echo 'Announcement Deleted';
                        return;
                    }
                }
            }
        }
    }

    public function addAnnouncements ()
    {
        if (array_key_exists ("type", $_SESSION))
        {
            if ($_SESSION['type'] != 'client')
            {
                echo 'yay!';
                $db_data['title'] = $this->input->post ('title');
                $db_data['text'] = $this->input->post ('content');
                $db_data['createdBy'] = $_SESSION['username'];
                $db_data['createdByType'] = $_SESSION['type'];
                $status = $this->am->addAnnouncement ($db_data);
            }
        }
    }
}
?>
