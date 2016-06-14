<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/login
	 *	- or -
	 * 		http://example.com/index.php/login/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if(!array_key_exists("username",$_POST)){
			echo "no post";
			return;
		}
		
		$this->load->database();
		
		$query = $this->db->query("SELECT username, givenName, lastName FROM technician WHERE username='".$_POST["username"]."'");
		$rows = $query->result_array();
		
		//if username was found in technician table
		if(count($rows) == 1){
			$query = $this->db->query(
				"SELECT username, givenName, lastName FROM technician WHERE username='".
				$_POST["username"]."' AND password=SHA1('".$_POST["password"]."')"
			);
			$rows = $query->result_array();
			if(count($rows) == 1){
				session_start();
				$_SESSION["type"] = "technician";
				$_SESSION["username"] = $_POST["username"];
				$_SESSION["givenName"] = $rows[0]['givenName'];
				$_SESSION["lastName"] = $rows[0]['lastName'];
				echo "Logged-on";
				return;
			}
			else {
				echo "Invalid password";
				return;
			}
		}
		else {
			
		}
	}
	
}
