<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class FileJobRequest extends CI_Controller
{
	public function index ()
	{
		//accessed via (base url)/login
		//keys in POST should be:
		//jobDescription - jod description or problems encountered
		//if the user in session is either an admin, superadmin, or technician
		//clientUsername - username of the client 
		
		//loads session to access session variables
		session_start();
		
		//if type array key is defined, it means there's a user currently logged-on in session 
		if(array_key_exists("type",$_SESSION)){
		
			//checks if jobDescription is defined in POST
			if(array_key_exists("jobDescription",$_POST)){
				
				//if the user in session is a client, post the job request under his name
				if($_SESSION["type"] === "client"){
			
					//loads codeigniter database library
					$this->load->database();
				
					//lookup the user ID of the currently logged-on user from the client table  
					$query = $this->db->query(
						"SELECT clientID FROM client WHERE username='".$_SESSION["username"]."'"
					);
					//sets rows from the db query result array 
					$rows = $query->result_array();
		
					//if there's a single row in the results array, it means the username exists and
					//we can retrieve the clientID
					if(count($rows) == 1){
						$clientID = $rows[0]["clientID"];
						$this->db->query(
							"INSERT INTO job (jobDescription, startDate, clientID, createdBy, createdByType, dateCreated)".
							"VALUES ('".$_POST["jobDescription"]."',NULL,".$clientID.",".$clientID.",'client', CURDATE())"
						);
						echo "Submitted";
					}
				
				}
			
				//if the user in session is either a technician or admin
				else if(($_SESSION["type"] === "technician")||($_SESSION["type"] === "admin")||($_SESSION["type"] === "superadmin")){
				
					//loads codeigniter database library
					$this->load->database();
					
					//since techinicians, admins, and superadmins can't file job requests
					//and they can only file job requests on behalf of a client,
					//clientUsername must be defined in post
					if(array_key_exists("clientUsername",$_POST)){
						
						//lookup the user ID from the client table  
						$query = $this->db->query(
							"SELECT clientID FROM client WHERE username='".$_POST["clientUsername"]."'" 
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
						
						//defines createdBy
						$createdBy = "";
						
						//if the user in session is either a technician or an admin
						if(($_SESSION["type"] === "technician")||($_SESSION["type"] === "admin")){
							//queries the DB for the admin ID of the user in session
							$query = $this->db->query(
								"SELECT adminID FROM adminAcc WHERE username='".
								$_SESSION["username"]."'" 
							);
							//sets rows from the db query result array 
							$rows = $query->result_array();
		
							//if there's a single row in the results array, it means the username exists and
							//we can retrieve the adminID and set it as createdBy
							if(count($rows) == 1){
								$createdBy = $rows[0]["adminID"];
							}
						}
						
						//if the user in session is a superadmin
						else {
							//queries the DB for the superadmin ID of the user in session
							$query = $this->db->query(
								"SELECT superAdminID FROM superAdmin WHERE username='".
								$_SESSION["username"]."'" 
							);
							//sets rows from the db query result array 
							$rows = $query->result_array();
		
							//if there's a single row in the results array, it means the username exists and
							//we can retrieve the superAdminID and set it as createdBy
							if(count($rows) == 1){
								$createdBy = $rows[0]["superAdminID"];
							}
						}
						//files a new job request in behalf of the client
						$this->db->query(
							"INSERT INTO job (jobDescription, startDate, clientID, createdBy, createdByType, dateCreated)".
							"VALUES ('".$_POST["jobDescription"]."',NULL,".$clientID.",".$createdBy.",'".$_SESSION["type"]."', CURDATE())"
						);
						echo "Submitted";
						
						
						
					}
					
					//if clientUsername is not defined
					else {
						die("clientUsername is not defined!");
					}
				}
				
			}
			
			//terminate script if jobDescription is not defined or if the script is accessed by any other method than post
			else {
				die("Can not be accessed by any other method than post or job description is not defined!");
			}
			
		}
		
		//else, there's no user currently logged-in in session
		else{
			echo "You need to be logged-on";
		}
	}
}
?>