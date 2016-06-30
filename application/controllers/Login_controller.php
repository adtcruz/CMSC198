<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

	public function index()
	{

		//to check if is accessed through POST
		//accessed via (base url)/login
		//keys in POST should be:
		//username - from username field
		//password - from password field, without SHA1 encryption, as it's this script that takes care of that

		if(!array_key_exists("username",$_POST)){
			exit('Can not be accessed by any other method');
		}
		if(!array_key_exists("password",$_POST)){
			exit('Can not be accessed by any other method');
		}

		//loads CodeIgniter database module
		$this->load->database();

		//queries the database if such a username entered exists in the technician table
		$query = $this->db->query("SELECT username FROM superAdmin WHERE BINARY username='".$_POST["username"]."'");
		//sets rows from the db query result array
		$rows = $query->result_array();
		if(count($rows) == 1){

			//queries the database to check if the username and password entered is correct
			$query = $this->db->query(
				"SELECT username, givenName, lastName FROM superAdmin WHERE username='".
				$_POST["username"]."' AND password=SHA1('".$_POST["password"]."')"
			);
			//sets rows from the db query result array
			$rows = $query->result_array();

			//if there's a single row in the results array, it means the user entered the correct password
			if(count($rows) == 1){
				session_start();
				$_SESSION["type"] = "superadmin";
				$_SESSION["username"] = $_POST["username"];
				$_SESSION["givenName"] = $rows[0]['givenName'];
				$_SESSION["lastName"] = $rows[0]['lastName'];
				//log user log-in
				$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES('".$_SESSION["username"]." logged-on',CURRENT_TIMESTAMP)");
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

		else{
			//queries the database if such a username entered exists in the technician table
			$query = $this->db->query("SELECT username FROM adminAcc WHERE BINARY username='".$_POST["username"]."'");
			//sets rows from the db query result array
			$rows = $query->result_array();

			//if there's a single row in the results array, it means username was found in technician table
			if(count($rows) == 1){

				//queries the database to check if the username and password entered is correct
				$query = $this->db->query(
					"SELECT username, givenName, lastName, isTechnician FROM adminAcc WHERE username='".
					$_POST["username"]."' AND password=SHA1('".$_POST["password"]."')"
				);
				//sets rows from the db query result array
				$rows = $query->result_array();

				//if there's a single row in the results array, it means the user entered the correct password
				if(count($rows) == 1){
					session_start();
					if($rows[0]['isTechnician']==1) $_SESSION["type"] = "technician";
					else $_SESSION["type"] = "admin";
					$_SESSION["username"] = $_POST["username"];
					$_SESSION["givenName"] = $rows[0]['givenName'];
					$_SESSION["lastName"] = $rows[0]['lastName'];
					//log user log-in
					$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES('".$_SESSION["username"]." logged-on',CURRENT_TIMESTAMP)");
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
				$query = $this->db->query("SELECT username FROM client WHERE BINARY username='".$_POST["username"]."'");
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
						//log user log-in
						$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES('".$_SESSION["username"]." logged-on',CURRENT_TIMESTAMP)");
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
}
