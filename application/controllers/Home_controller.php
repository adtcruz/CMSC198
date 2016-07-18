<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_controller extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();
        session_start();
        $this->load->model ('Home_dash_model', 'hdm');
        $this->load->model ('Announcements_model', 'am');
        $this->load->model ('Notifications_model', 'nm');
    }

    public function index ()
	{
		if(array_key_exists("type",$_SESSION))
        {
            // load header
            $this->load->view ('Header');
            // initialize current announcements
            $db_data['announcements'] = $this->am->getDashAnnouncements ();

            switch ($_SESSION['type'])
            {
                case 'client':
                    $db_data['clientData'] = $this->hdm->getClientData ($_SESSION['username']);
                    $this->load->view ('Home_Dash_Client', $db_data);
                break;
                case 'admin':
                case 'technician':
                case 'superadmin':
                    $db_data['unread'] = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
                    $this->load->view ('Home_Dash_Admin', $db_data);
                break;
                default:
                    $this->load->view ('Login_view');
                return;
            }
            $this->load->view ('Common_scripts');
            $this->load->view ('Home_script');
            $this->load->view ('Logout_script');
		}
		else
        {
			$this->load->view('Login_view');
		}
	}
}
?>
