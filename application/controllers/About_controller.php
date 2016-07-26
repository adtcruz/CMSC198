<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About_controller extends CI_Controller
{
	public function __construct ()
	{
		parent::__construct ();
		session_start();
		$this->load->model('Notifications_model', 'nm');
	}

	public function index ()
	{
    if(array_key_exists("type",$_SESSION))
    {
    	if($_SESSION["type"] == "client"){

	  		$db_data['unread'] = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
	  		$this->load->view ('About_view', $db_data);
			}
			else
	    	{
				$this->load->view('Login_view');
			}
		}
	}
}

?>
