<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submit_job_request_controller extends CI_Controller
{
	public function index ()
	{
		//accessed via (base url)/submit_request
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

					$this->load->model('Submit_job_request_model','sjrm');

					$query = $this->sjrm->getClientQueryRows($_SESSION["username"]);
					//sets rows from the db query result array
					$rows = $query->result_array();

					//if there's a single row in the results array, it means the username exists and
					//we can retrieve the clientID
					if(count($rows) == 1){
						$clientID = $rows[0]["clientID"];

						$query = $this->sjrm->submitJobRequest($_POST["jobDescription"],$_SESSION["username"],$clientID,$clientID,"client","");

						echo "Submitted";
					}

				}

				//if the user in session is either a technician or admin
				else if(($_SESSION["type"] === "technician")||($_SESSION["type"] === "admin")||($_SESSION["type"] === "superadmin")){

					$this->load->model('Submit_job_request_model','sjrm');

					//since techinicians, admins, and superadmins can't file job requests
					//and they can only file job requests on behalf of a client,
					//clientUsername must be defined in post
					if(array_key_exists("clientUsername",$_POST)){

						//lookup the user ID from the client table
						$query = $this->sjrm->getClientQueryRows($_POST["clientUsername"]);
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
							$createdBy = $this->sjrm->getAdminID($_SESSION["username"]);
						}

						//if the user in session is a superadmin
						else {
							$createdBy = $this->sjrm->getSuperAdminID($_SESSION["username"]);
						}

						$query = $this->sjrm->submitJobRequest($_POST["jobDescription"],$_SESSION["username"],$clientID,$createdBy,$_SESSION["type"]," in behalf of ".$_POST["clientUsername"]."");

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
