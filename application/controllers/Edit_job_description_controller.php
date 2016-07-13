<?php
//this is the controller for the API that edits the job description of a job
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_job_description_controller extends CI_Controller
{
	public function index ()
	{

		//session start to access session variables
		session_start();

		//checks if type array key exists in session
		if(array_key_exists("type",$_SESSION)){

			//checks if jobID array key exists in POST
			if(array_key_exists("jobID",$_POST)){

				//checks if jobDescription array key exists in POST
        if(array_key_exists("jobDescription",$_POST)){

					//loads codeigniter database module
          $this->load->database();

					//checks if the user in session is a superadmin
					//superadmins may edit the job description regardless of who filed it
  				if($_SESSION["type"]==="superadmin"){

						//updates the job description of the job identified by the jobID in post
  					$this->db->query("UPDATE job SET jobDescription='".$_POST["jobDescription"]."' WHERE jobID=".$_POST["jobID"]."");

						//checks for the number of jobIDs with the new jobDescription
            $query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND jobDescription='".$_POST["jobDescription"]."'");

						//gets the query result row
  					$row = $query->row_array();

						//if there is a single row, it means that the job description was updated
  					if ($row["COUNT(jobID)"]==1){

							//record this action to the user logs
              $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." changed the job description of jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

							//send a message that the job description was updated
              echo "Job description updated";
  					}
  				}

					//checks if the user in session is an admin
					//admins may only edit the job description if they filed the job request in behalf of a client
  				if($_SESSION["type"]==="admin"){

						//gets the admin ID of the user in session
  					$adminID = $this->db->query("SELECT adminID FROM adminAcc WHERE username='".$_SESSION["username"]."'")->result_array()[0]["adminID"];

						//checks if the job was filed by the user in session
  					$query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND createdBy=".$adminID." AND createdByType='admin'");
  					$row = $query->row_array();
  					if ($row["COUNT(jobID)"]==1){

							//if it is filed by the user in session, update the job description
              $this->db->query("UPDATE job SET jobDescription='".$_POST["jobDescription"]."' WHERE jobID=".$_POST["jobID"]."");

							//checks for the number of jobIDs with the new jobDescription
              $query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND jobDescription='".$_POST["jobDescription"]."'");

							//gets the query result row
              $row = $query->row_array();

							//if there is a single row, it means that the job description was updated
              if ($row["COUNT(jobID)"]==1){

								//record this action to the user logs
                $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." changed the job description of jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

								//send a message that the job description was updated
                echo "Job description updated";
              }
  					}
  				}

					//checks if the user in session is a technician
					//technicians may only edit the job description if they filed the job request in behalf of a client
  				if($_SESSION["type"]==="technician"){

						//gets the admin ID of the user in session
  					$adminID = $this->db->query("SELECT adminID FROM adminAcc WHERE username='".$_SESSION["username"]."'")->result_array()[0]["adminID"];

						//checks if the job was filed by the user in session
  					$query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND createdBy=".$adminID." AND createdByType='technician'");
  					$row = $query->row_array();
						if ($row["COUNT(jobID)"]==1){

							//if it is filed by the user in session, update the job description
              $this->db->query("UPDATE job SET jobDescription='".$_POST["jobDescription"]."' WHERE jobID=".$_POST["jobID"]."");

							//checks for the number of jobIDs with the new jobDescription
              $query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND jobDescription='".$_POST["jobDescription"]."'");

							//gets the query result row
              $row = $query->row_array();

							//if there is a single row, it means that the job description was updated
              if ($row["COUNT(jobID)"]==1){

								//record this action to the user logs
                $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." changed the job description of jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

								//send a message that the job description was updated
                echo "Job description updated";
              }
  					}
  				}

					//checks if the user in session is a client
					//clients may only edit the job description if they filed the job request themselves
  				if($_SESSION["type"]==="client"){

						//gets the clientID of thew user in session
  					$clientID = $this->db->query("SELECT clientID FROM client WHERE username='".$_SESSION["username"]."'")->result_array()[0]["clientID"];

						//checks if the job was filed by the user in session
  					$query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND createdBy=".$clientID." AND createdByType='client'");
						$row = $query->row_array();
  					if ($row["COUNT(jobID)"]==1){

							//if it is filed by the user in session, update the job description
              $this->db->query("UPDATE job SET jobDescription='".$_POST["jobDescription"]."' WHERE jobID=".$_POST["jobID"]."");

							//checks for the number of jobIDs with the new jobDescription
              $query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND jobDescription='".$_POST["jobDescription"]."'");

							//gets the query result row
              $row = $query->row_array();

							//if there is a single row, it means that the job description was updated
              if ($row["COUNT(jobID)"]==1){

								//record this action to the user logs
                $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." changed the job description of jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

								//send a message that the job description was updated
                echo "Job description updated";
              }
  					}
  				}
        }
			}
		}
  }
}
?>
