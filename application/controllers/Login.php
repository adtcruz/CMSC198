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
	 */
	public function index()
	{
		/*
		$this->load->helper('url');
		$this->load->view('Login_view');
		*/
		//to check if is accessed through POST, since this API should only be accessed through AJAX
		if(!array_key_exists("username",$_POST)){
			exit('Can not be accessed by any other method');
		}
		
		//loads CodeIgniter database module
		$this->load->database();
		
		//queries the database if such a username entered exists in the technician table
		$query = $this->db->query("SELECT username FROM technician WHERE username='".$_POST["username"]."'");
		//sets rows from the db query result array 
		$rows = $query->result_array();
		
		//if there's a single row in the results array, it means username was found in technician table
		if(count($rows) == 1){
		
			//queries the database to check if the username and password entered is correct
			$query = $this->db->query(
				"SELECT username, givenName, lastName FROM technician WHERE username='".
				$_POST["username"]."' AND password=SHA1('".$_POST["password"]."')"
			);
			//sets rows from the db query result array
			$rows = $query->result_array();
			
			//if there's a single row in the results array, it means the user entered the correct password
			if(count($rows) == 1){
				session_start();
				$_SESSION["type"] = "technician";
				$_SESSION["username"] = $_POST["username"];
				$_SESSION["givenName"] = $rows[0]['givenName'];
				$_SESSION["lastName"] = $rows[0]['lastName'];
				echo "Logged-on";
				return;
			}
			
			//otherwise, the user did not enter the right password
			else {
				//send a message that the user did not enter the right password
				echo "Invalid";
				return;
			}
		}
		else {
			//queries the database if such a username entered exists in the client tables
			$query = $this->db->query("SELECT username FROM client WHERE username='".$_POST["username"]."'");
			//sets rows from the db query result array 
			$rows = $query->result_array();
			
			//if there's a single row in the results array, it means the username was found in the client table
			if(count($rows) == 1){
				//queries the database if the username and password entered is correct
				$query = $this->db->query(
					"SELECT username, givenName, lastName, designation, officeId FROM client WHERE username='".
					$_POST["username"]."' AND password=SHA1('".$_POST["password"]."')"
				);
				//sets rows from the db query result array
				$rows = $query->result_array();
				
				//if there's a single row in the results array, it means the user entered the correct password
				if(count($rows) == 1){
					session_start();
					$_SESSION["type"] = "client";
					$_SESSION["username"] = $_POST["username"];
					$_SESSION["givenName"] = $rows[0]['givenName'];
					$_SESSION["lastName"] = $rows[0]['lastName'];
					$_SESSION["designation"] = $rows[0]['designation'];
					//insert place office name here later
					echo "Logged-on";
					return;					
				}
				
				//otherwise, the user did not enter the right password
				else {
					//send a message that the user did not enter the right password
					echo "Invalid";
					return;
				}
			}
			
			//else, it's an invalid credential
			else {
				echo "Invalid";
				return;
			}
		}
	}
}
