<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancel_job_controller extends CI_Controller
{
	public function index ()
	{

    //to check if is accessed through POST
		//accessed via (base url)/login
		//keys in POST should be:
		//jobID - to be passed by jQuery POST communication from
    if(!array_key_exists("jobID",$_POST)){
      die("Can not be accessed by any method other than POST.");
    }

    //starts session to access session variables
    session_start();

    //checks if username is defined in session
    //if it's defined, it means there is a user in session and the connection
    //is from the browser
		if(!array_key_exists("username",$_SESSION)){
      die("There is no user in sesssion.");
    }

    //loads codeigniter database module
    $this->load->database();

    //superadmin may cancel any job
    if($_SESSION["type"] == "superadmin"){

      $this->db->query("UPDATE job SET jobStatus='CANCELED' WHERE jobID=".$_POST["jobID"]."");

      if($this->db->query("SELECT jobStatus FROM job WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["jobStatus"] == "CANCELED"){
				//log this action into USERLOGS
				$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES('".$_SESSION["username"]." canceled jodID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");
        echo "Job canceled";
        return;
      }
      else {
        echo "Error in job cancelation";
        return;
      }
    }

    //technicians and admins may cancel jobs that they filed in behalf of a client
    if(($_SESSION["type"] == "technician")||($_SESSION["type"] == "admin")){

      //queries the database for the user's adminID
      $query = $this->db->query("SELECT adminID FROM adminAcc WHERE username='".$_SESSION["username"]."'");
      $rows = $query->result_array();

      //saves the user's client ID
      $adminID = $rows[0]["adminID"];

      $this->db->query("UPDATE job SET jobStatus='CANCELED' WHERE jobID=".$_POST["jobID"]." AND createdBy=".$adminID."");

      if($this->db->query("SELECT jobStatus FROM job WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["jobStatus"] == "CANCELED"){
				//log this action into USERLOGS
				$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES('".$_SESSION["username"]." canceled jodID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");
        echo "Job canceled";
        return;
      }
      else {
        echo "Error in job cancelation";
        return;
      }
    }

    //clients can only cancel jobs that are filed under their name
    if($_SESSION["type"] == "client"){

      //queries the database for the user's clientID
      $query = $this->db->query("SELECT clientID FROM client WHERE username='".$_SESSION["username"]."'");
      $rows = $query->result_array();

      //saves the user's client ID
      $clientID = $rows[0]["clientID"];

      $this->db->query("UPDATE job SET jobStatus='CANCELED' WHERE jobID=".$_POST["jobID"]." AND clientID=".$clientID." AND jobStatus='PENDING'");

      if($this->db->query("SELECT jobStatus FROM job WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["jobStatus"] == "CANCELED"){
				//log this action into USERLOGS
				$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES('".$_SESSION["username"]." canceled jodID #".$_POST["jobID"]."',CURRENT_TIMESTAMP)");
        echo "Job canceled";
        return;
      }
      else {
        echo "Error in job cancelation";
        return;
      }
    }
	}
}
?>
