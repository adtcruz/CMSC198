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
            /*
            switch ($_SESSION['type'])
            {
                case 'client':
                    $db_data = $this->hdm->getClientData ($_SESSION['username']);
                break;
                case 'admin':
                    $db_data = $this->hdm->getAdminData ($_SESSION['username']);
                break;
                case 'superadmin':
                    $db_data = $this->hdm->getSAData ($_SESSION['username']);
                break;
                default:
                    $this->load->view ('Login_view');
            }*/
            $this->load->view ('Home_view');
		}
		else
        {
			$this->load->view('Login_view');
		}
	}
}
?>
