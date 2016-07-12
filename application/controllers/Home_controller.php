<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();
        session_start();
        $this->load->model ('Home_dash_model', 'hdm');
        $this->load->model ('Announcements_model', 'am');
    }

    public function index ()
	{
		if(array_key_exists("type",$_SESSION))
        {
            // start of Home_Dash
            $this->load->view ('Header');
            $db_data['announcements'] = $this->am->getDashAnnouncements ();
            switch ($_SESSION['type'])
            {
                case 'client':
                    $db_data['clientData'] = $this->hdm->getClientData ($_SESSION['username']);
                    $this->load->view ('Home_Dash_Client', $db_data);
                break;
                case 'admin':
                case 'technician':
                    $db_data['schedule'] = $this->hdm->getSchedule ();
                    $this->load->view ('Home_Dash_Admin', $db_data);
                break;
                case 'superadmin':
                    //$db_data = $this->hdm->getSAData ($_SESSION['username']);
                    $this->load->view ('Home_Dash_SuperAdmin');
                break;
                default:
                    $this->load->view ('Login_view');

                return;
            }
            $this->load->view ('Common_scripts');
            $this->load->view ('Home_script');
            $this->load->view ('Logout_script');
            // end of Home_Dash
		}
		else
        {
			$this->load->view('Login_view');
		}
	}
}
?>
