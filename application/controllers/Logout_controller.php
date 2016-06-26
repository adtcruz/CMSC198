<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout_controller extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/logout
	 *	- or -
	 * 		http://example.com/index.php/logout/index
	 */
	public function index(){

		//loads session to access session variables
		session_start();

		//loads codeigniter database module
		$this->load->database();

		//log user log-out
		$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES('".$_SESSION["username"]." logged-out',CURRENT_TIMESTAMP)");

		//sets session into a blank array
		$_SESSION = array();

		//destroys the session variable
		session_destroy();
	}
}
