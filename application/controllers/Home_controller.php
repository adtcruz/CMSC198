<?php
/*
*   file: Home_controller.php
*       This is the default controller. It re-directs unregistered users to the login page and the registered users to their respective homepage.
*/
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
        $this->load->model ('Chart_model', 'cm');
    }

    public function index ()
	{
		if(array_key_exists("type",$_SESSION))
        {
            // load header
            $this->load->view ('Header');
            $this->load->view ('Navbar');
            // initialize current announcements
            $db_data['announcements'] = $this->am->getDashAnnouncements ();
            // load data based on user type
            switch ($_SESSION['type'])
            {
                case 'client':
                    // load client data
                    $db_data['clientData'] = $this->hdm->getClientData ($_SESSION['username']);
                    // load unread notifications counter
                    $db_data['unread'] = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
                    // load view
                    $this->load->view ('Home_Dash_Client', $db_data);
                break;
                case 'admin':
                case 'technician':
                    // load unread notifications counter
                    $db_data['unread'] = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
                    // load view
                    $this->load->view ('Home_Dash_Admin', $db_data);
                break;
                case 'superadmin':
                    // load unread notifications counter
                    $db_data['unread'] = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
                    // load total jobs data
                    $db_data['total'] = $this->cm->getTotalJobStatus ();
                    // load total work done data
                    $db_data['values'] = $this->cm->getWorkServiced ();
                    // load income data
                    $db_data['income'] = $this->cm->getMonthlyIncome ();
                    // load view
                    $this->load->view ('Home_Dash_SuperAdmin', $db_data);
                break;
                default:
                    // redirect to root view
                    redirect ('Login_view', 'refresh');
                return;
            }
            // load common used scripts
            $this->load->view ('Common_scripts');
            // load scripts for chart use (highcharts.js)
            $this->load->view ('Chart_script');
            // load script for home page along with chart instances
            $this->load->view ('Home_script');
            // load script for logout
            $this->load->view ('Logout_script');
		}
		else
        {
			$this->load->view('Login_view');
		}
	}
}
?>
