<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/logout
	 *	- or -
	 * 		http://example.com/index.php/logout/index
	 */
	public function index(){
		session_start();
		$_SESSION = array();
		session_destroy();
	}
}
