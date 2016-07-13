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
        if (array_key_exists ('type', $_SESSION))
        {
            switch ($_SESSION['type'])
            {
                case 'client':
                    $db_data = $this->am->getAnnouncements ();
                    $this->load->view ('Announcements_client_view', $db_data);
                break;
                case 'admin':
                case 'technician':
                case 'superadmin':
                    $this->form_validation->set_rules ('title', 'Title', 'trim|required|min_length[10]', array(
                        'required' => 'Title is required', 'min_length' => 'Title is too short'
                    ));
                    $this->form_validation->set_rules ('text', 'Text', 'trim|required|min_length[10]', array(
                        'required' => 'Text is required', 'min_length' => 'Content is too short'
                    ));

                    if ($this->form_validation->run() == FALSE)
                    {
                        $db_data = $this->am->getAnnouncements ();
                        $this->load->view ('Announcements_admin_view', $db_data);
                    }
                    else
                    {
                        // target toggle modal or something
                    }
                break;
                default: // redirect
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
                $db_data['text'] = $this->input->post ('text');
                $db_data['createdBy'] = $_SESSION['username'];
                $db_data['createdByType'] = $_SESSION['type'];
                $status = $this->am->addAnnouncement ($db_data);
                echo '<br/>'.$db_data['title'].' '.$db_data['text'].' '.$db_data['createdBy'].' '.$db_data['createdByType'];
                echo '<br/>current status'.$status;
            }
        }
    }
}
?>
