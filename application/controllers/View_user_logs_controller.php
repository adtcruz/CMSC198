<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_user_logs_controller extends CI_Controller
{
	public function index ()
	{
		session_start();
		if(array_key_exists("type",$_SESSION))
        {
			if($_SESSION["type"]==="superadmin")
            {
				$this->load->model('View_user_logs_model','vulm');
                $this->load->model ('Notifications_model', 'nm');
				$logsTable = $this->vulm->getLogEntries();
                $unread = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
				$this->load->view('View_user_logs_view',array('logsTable' => $logsTable, 'unread' => $unread));
			}
            else
            {
    			redirect (base_url(), 'refresh');
    		}
		}
        else
        {
            redirect (base_url(), 'refresh');
        }
	}
}
?>
