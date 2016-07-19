<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class New_account_controller extends CI_Controller
{
    function index()
    {
        $this->load->model('Job_requests_model','jrm');
        $this->load->model ('Notifications_model', 'nm');
        session_start();
        $options = "";
        if(array_key_exists("type",$_SESSION))
        {
            if($_SESSION['type'] != 'client')
            {
                $db_data['options'] = $this->jrm->getOffices($_SESSION['type']);
                $db_data['unread'] = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
                $this->load->view('New_account_view', $db_data);
            }
        }
        else
        {
            $this->load->view('Login_view');
        }
    }
}
?>
