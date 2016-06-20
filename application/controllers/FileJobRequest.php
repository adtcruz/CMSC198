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
		
		//check if username is defined in session
		//this shall be used to determine the value of the createdBy field of the job request
		if(!array_key_exists("username",$_POST)){
			exit('Username not defined');
		}
		$username = $_POST["username"];
		
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
			"SELECT clientID FROM client WHERE username='".$username."'"
		);
		//sets rows from the db query result array 
		$rows = $query->result_array();
		
		//if there's a single row in the results array, it means the username exists and
		//we can retrieve the clientID
		if(count($rows) == 1){
			$createdBy = $rows[0]["clientID"];
			$this->db->query(
				"INSERT INTO job (jobDescription, startDate, clientID, createdBy, createdByType, dateCreated)".
				"VALUES ('".$_POST["jobDescription"]."',NULL,".$clientID.",".$createdBy.",'client', CURDATE())"
			);
			echo "Submitted";
		}
		//otherwise, the username was not found in client table
		//so we have to look it up from the admin table
		else {
			//lookup the user ID of the currently logged-on user from the client table  
			$query = $this->db->query(
				"SELECT adminID FROM adminAcc WHERE username='".$username."'"
			);
			//sets rows from the db query result array 
			$rows = $query->result_array();
			
			//we can retrieve the adminID
			if(count($rows) == 1){
				$createdBy = $rows[0]["adminID"];
				$this->db->query(
					"INSERT INTO job (jobDescription, startDate, clientID, createdBy, createdByType, dateCreated)".
					"VALUES ('".$_POST["jobDescription"]."',NULL,".$clientID.",".$createdBy.",'admin', CURDATE())"
				);
				echo "Submitted";
			}
			//otherwise, the username was not found in admin table
			//so we have to look it up from the superadmin table
			else {
				//lookup the user ID of the currently logged-on user from the client table  
				$query = $this->db->query(
					"SELECT superAdminID FROM superAdmin WHERE username='".$username."'"
				);
				//sets rows from the db query result array 
				$rows = $query->result_array();
			
				//we can retrieve the superAdminID
				if(count($rows) == 1){
					$createdBy = $rows[0]["superAdminID"];
					$this->db->query(
						"INSERT INTO job (jobDescription, startDate, clientID, createdBy, createdByType, dateCreated)".
						"VALUES ('".$_POST["jobDescription"]."',NULL,".$clientID.",".$createdBy.",'superadmin', CURDATE())"
					);
					echo "Submitted";
				}
				else {
					echo "Username not found";
					die();
				}
			}
		}
	}
}
?>