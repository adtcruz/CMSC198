<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_user_type extends CI_Controller
{
	public function index ()
	{
		session_start();
		echo $_SESSION["type"];
	}
}
?>