<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class FileJobRequest extends CI_Controller
{
	public function index ()
	{
		//check if clientusername array key in POST exists
		//this shall be used to determine the client ID of the job request to be created 
		if(!array_key_exists("clientUsername",$_POST)){
			exit('Can not be accessed by any other method');
		}
		
		
		//putting this just for testing this API
		if(!array_key_exists("username",$_POST)){
			exit('Can not be accessed by any other method');
		}
		$username = $_POST["username"];
		
		
		/*
		//start session to access SESSION variables
		session_start();
		
		//check if username is defined in session
		//this shall be used to determine the value of the createdBy field of the job request
		if(!array_key_exists("username",$_SESSION)){
			exit('username not defined in SESSION');
		}
		$username = $_SESSION["username"];
		*/
		
		//loads codeigniter database library
		$this->load->database();
		
		//lookup the user ID from the client table  
		$query = $this->db->query(
			"SELECT clientID FROM client WHERE username='".
			$_POST["clientUsername"]."'" 
		);
		//sets rows from the db query result array 
		$rows = $query->result_array();
		
		//if there's a single row in the results array, it means the username exists and
		//we can retrieve the clientID
		if(count($rows) == 1){
			$clientID = $rows[0]["clientID"];
		}
		//otherwise, the username was not found
		else {
			//throw an error and terminate the execution
			echo "Username specified not a client";
			die();
		}
		
		//lookup the user ID of the currently logged-on user from the client table  
		$query = $this->db->query(
			"SELECT clientID FROM client WHERE username='".$username."'");
		//sets rows from the db query result array 
		$rows = $query->result_array();
		
		//if there's a single row in the results array, it means the username exists and
		//we can retrieve the clientID
		if(count($rows) == 1){
			$createdBy = $rows[0]["clientID"];
			
		}
		//otherwise, the username was not found
		else {
			
		}
	}
}
?>