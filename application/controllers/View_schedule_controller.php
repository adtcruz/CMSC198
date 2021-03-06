<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_schedule_controller extends CI_Controller
{
	public function __construct ()
	{
		parent::__construct ();
		session_start();
		if(array_key_exists("type",$_SESSION)){
			$this->load->model ('View_schedule_model', 'sm');
            $this->load->model ('Notifications_model', 'nm');
		}

		else{

			$this->load->view('Login_view');
		}
	}

	public function index ()
	{
		$table = $this->sm->processScheduleTable();
        $unread = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
		$this->load->view ('View_schedule_view', array('table' => $table, 'unread' => $unread));
	}
}

?>
