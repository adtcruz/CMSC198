<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_job_description_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(array_key_exists("jobID",$_POST)){

				$this->load->database();

				if($_SESSION["type"]==="superadmin"){

					echo $this->db->query("SELECT jobDescription FROM job WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["jobDescription"];
				}

				if($_SESSION["type"]==="admin"){

					$adminID = $this->db->query("SELECT adminID FROM adminAcc WHERE username='".$_SESSION["username"]."'")->result_array()[0]["adminID"];

					$query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND createdBy=".$adminID." AND createdByType='admin'");

					$row = $query->row_array();

					if ($row["COUNT(jobID)"]==1){
						echo $this->db->query("SELECT jobDescription FROM job WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["jobDescription"];
					}
				}

				if($_SESSION["type"]==="technician"){

					$adminID = $this->db->query("SELECT adminID FROM adminAcc WHERE username='".$_SESSION["username"]."'")->result_array()[0]["adminID"];

					$query = $this->db->query("SELECT COUNT(jobID) FROM job WHERE jobID=".$_POST["jobID"]." AND createdBy=".$adminID." AND createdByType='technician'");

					$row = $query->row_array();

					if ($row["COUNT(jobID)"]==1){
						echo $this->db->query("SELECT jobDescription FROM job WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["jobDescription"];
					}
				}

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
