<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_account_controller extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();
        $this->load->model ('Notifications_model', 'nm');
    }

    public function index ()
	{
		session_start();
		if(array_key_exists("type",$_SESSION))
    {
      if(($_SESSION["type"]==="admin")||($_SESSION["type"]==="technician")||($_SESSION["type"]==="superadmin"))$unread = $this->nm->getUnreadCount($_SESSION['username'], $_SESSION['type']);
      else $unread['unread'] = 0;
			$this->load->view('My_account_view', $unread);
		}
		else
    {
        redirect (base_url (), 'refresh');
		}
	}
}
?>
