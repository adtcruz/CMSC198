<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate_bill_controller extends CI_Controller
{
	public function __construct ()
	{
		parent::__construct ();
		session_start();
		$this->load->model ('Generate_bill_model', 'gbm');
		$this->load->model ('Notifications_model', 'nm');
	}

	public function index ()
	{
        if(array_key_exists("type",$_SESSION))
        {
            if ($_SESSION['type'] === 'client')
            {
                $db_data = $this->gbm->getData ($_SESSION['username']);
        		$db_data['unread'] = $this->nm->getUnreadCount($_SESSION['username'], ($_SESSION['type']));
          		$this->load->view ('Generate_bill_view', $db_data);
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
