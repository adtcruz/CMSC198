<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About_controller extends CI_Controller
{
	public function __construct ()
	{
		parent::__construct ();
		session_start();
	}

	public function index ()
	{
    if(array_key_exists("type",$_SESSION))
    {
    	if($_SESSION["type"] == "client"){

	  		$this->load->view ('About_view');
			}
			else
	    	{
				$this->load->view('Login_view');
			}
		}
	}
}

?>
