<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Announcements_controller extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();
        $this->load->model ('Announcements_model', 'am');
    }

    public function index ()
    {
        $db_data = $this->am->getAnnouncements ();
        $this->load->view ('Announcements_view', $db_data);
    }

    public function addAnnouncements ()
    {
        session_start ();
        if (array_key_exists ("type", $_SESSION))
        {
            if ($_SESSION['type'] != 'client')
            {
                $db_data['title'] = $this->input->post ('annTitle');
                $db_data['text'] = $this->input->post ('annText');
                $db_data['createdBy'] = $_SESSION['username'];
                $db_data['createdByType'] = $_SESSION['type'];
                $this->am->addAnnouncement ($db_data);
            }
            else
            {
                redirect (base_url(), 'refresh');
            }
        }
    }
}
?>
