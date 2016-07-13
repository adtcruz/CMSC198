<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Announcements_controller extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();
        $this->load->model ('Announcements_model', 'am');
        $this->load->helper ('form');
        $this->load->library ('form_validation');
        session_start();
    }

    public function index ()
    {
        $this->form_validation->set_rules ('title', 'Title', 'trim|required|min_length[10]|max_length[128]', array(
            'required' => 'Title is required', 'min_length' => 'Input is too short', 'max_length' => 'Input is too long'
        ));
        $this->form_validation->set_rules ('text', 'Text', 'trim|required|min_length[10]|max_length[1024]', array(
            'required' => 'Text is required', 'min_length' => 'Input is too short', 'max_length' => 'Input is too long'
        ));

        if ($this->form_validation->run() == FALSE)
        {
            $db_data = $this->am->getAnnouncements ();
            $this->load->view ('Announcements_view', $db_data);
        }
        else
        {
            // target toggle modal or something
        }
    }

    public function addAnnouncements ()
    {
        if (array_key_exists ("type", $_SESSION))
        {
            if ($_SESSION['type'] != 'client')
            {
                $db_data['title'] = $this->input->post ('title');
                $db_data['text'] = $this->input->post ('content');
                $db_data['createdBy'] = $_SESSION['username'];
                $db_data['createdByType'] = $_SESSION['type'];
                $this->am->addAnnouncement ($db_data);
            }
        }
    }
}
?>
