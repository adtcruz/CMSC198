<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_job_description_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(array_key_exists("jobID",$_POST)){

        if(array_key_exists("jobDescription",$_POST)){

          $this->load->database();

  				if($_SESSION["type"]==="superadmin"){

  					$this->db->query("UPDATE job SET jobDescription='".$_POST["jobDescription"]."' WHERE jobID=".$_POST["jobID"]."");

            $query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND jobDescription='".$_POST["jobDescription"]."'");

  					$row = $query->row_array();

  					if ($row["COUNT(jobID)"]==1){

              $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." changed the job description of jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

              echo "Job description updated";
  					}
  				}

  				if($_SESSION["type"]==="admin"){

  					$adminID = $this->db->query("SELECT adminID FROM adminAcc WHERE username='".$_SESSION["username"]."'")->result_array()[0]["adminID"];

  					$query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND createdBy=".$adminID." AND createdByType='admin'");

  					$row = $query->row_array();

  					if ($row["COUNT(jobID)"]==1){

              $this->db->query("UPDATE job SET jobDescription='".$_POST["jobDescription"]."' WHERE jobID=".$_POST["jobID"]."");

              $query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND jobDescription='".$_POST["jobDescription"]."'");

              $row = $query->row_array();

              if ($row["COUNT(jobID)"]==1){

                $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." changed the job description of jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

                echo "Job description updated";
              }
  					}
  				}

  				if($_SESSION["type"]==="technician"){

  					$adminID = $this->db->query("SELECT adminID FROM adminAcc WHERE username='".$_SESSION["username"]."'")->result_array()[0]["adminID"];

  					$query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND createdBy=".$adminID." AND createdByType='technician'");

  					$row = $query->row_array();

  					if ($row["COUNT(jobID)"]==1){
              $this->db->query("UPDATE job SET jobDescription='".$_POST["jobDescription"]."' WHERE jobID=".$_POST["jobID"]."");

              $query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND jobDescription='".$_POST["jobDescription"]."'");

              $row = $query->row_array();

              if ($row["COUNT(jobID)"]==1){

                $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." changed the job description of jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

                echo "Job description updated";
              }
  					}
  				}

  				if($_SESSION["type"]==="client"){

  					$clientID = $this->db->query("SELECT clientID FROM client WHERE username='".$_SESSION["username"]."'")->result_array()[0]["clientID"];

  					$query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND createdBy=".$clientID." AND createdByType='client'");

  					$row = $query->row_array();

  					if ($row["COUNT(jobID)"]==1){
              $this->db->query("UPDATE job SET jobDescription='".$_POST["jobDescription"]."' WHERE jobID=".$_POST["jobID"]."");

              $query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND jobDescription='".$_POST["jobDescription"]."'");

              $row = $query->row_array();

              if ($row["COUNT(jobID)"]==1){

                $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." changed the job description of jobID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");

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
