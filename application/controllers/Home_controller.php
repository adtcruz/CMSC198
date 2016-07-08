<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();
        session_start();
        $this->load->model ('Home_dash_model', 'hdm');
    }

    public function index ()
	{
		if(array_key_exists("type",$_SESSION))
        {
            $this->load->view ('Header');
            switch ($_SESSION['type'])
            {
                case 'client':
                    $db_data = $this->hdm->getClientData ($_SESSION['username']);
                    $this->load->view ('Home_Dash_Client', $db_data);
                break;
                case 'admin':
                    $this->load->view ('Home_Dash_Admin');
                break;
                case 'technician':
                    $db_data = $this->hdm->getAdminData ($_SESSION['username']);
                    $this->load->view ('Home_Dash_Technician');
                break;
                case 'superadmin':
                    $db_data = $this->hdm->getSAData ($_SESSION['username']);
                    $this->load->view ('Home_Dash_SuperAdmin');
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
