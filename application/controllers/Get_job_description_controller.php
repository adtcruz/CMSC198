<?php
//this is the controller for the API to get the job description of a job request
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_job_description_controller extends CI_Controller
{
	public function index ()
	{

		//session start to access session variables
		session_start();

    //checks if the type array key exists in session
    //if it does it means that there is a user currently in session
		if(array_key_exists("type",$_SESSION)){

			//checks if jobID array key exists in POST
			if(array_key_exists("jobID",$_POST)){

				//loads codeigniter database module
				$this->load->database();

				//if the user in session is a superadmin
				//since superadmins may edit any job request, just return the job description of the specified jobID
				if($_SESSION["type"]==="superadmin"){
					echo $this->db->query("SELECT jobDescription FROM job WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["jobDescription"];
				}

				//if the user in session is an admin
				//since admins, technicians, and clients may only edit job requests that they filed,
				//check first if they filed the job request identified by jobID before returning the jobDescription
				if($_SESSION["type"]==="admin"){
					$adminID = $this->db->query("SELECT adminID FROM adminAcc WHERE username='".$_SESSION["username"]."'")->result_array()[0]["adminID"];
					$query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND createdBy=".$adminID." AND createdByType='admin'");
					$row = $query->row_array();
					if ($row["COUNT(jobID)"]==1){
						echo $this->db->query("SELECT jobDescription FROM job WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["jobDescription"];
					}
				}

				//if the user in session is an admin
				//since admins, technicians, and clients may only edit job requests that they filed,
				//check first if they filed the job request identified by jobID before returning the jobDescription
				if($_SESSION["type"]==="technician"){
					$adminID = $this->db->query("SELECT adminID FROM adminAcc WHERE username='".$_SESSION["username"]."'")->result_array()[0]["adminID"];
					$query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND createdBy=".$adminID." AND createdByType='technician'");
					$row = $query->row_array();
					if ($row["COUNT(jobID)"]==1){
						echo $this->db->query("SELECT jobDescription FROM job WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["jobDescription"];
					}
				}

				//if the user in session is an admin
				//since admins, technicians, and clients may only edit job requests that they filed,
				//check first if they filed the job request identified by jobID before returning the jobDescription
				if($_SESSION["type"]==="client"){
					$clientID = $this->db->query("SELECT clientID FROM client WHERE username='".$_SESSION["username"]."'")->result_array()[0]["clientID"];
					$query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND createdBy=".$clientID." AND createdByType='client'");
					$row = $query->row_array();
					if ($row["COUNT(jobID)"]==1){
						echo $this->db->query("SELECT jobDescription FROM job WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["jobDescription"];
					}
				}
			}
		}
  }
}
?>
