<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_job_controller extends CI_Controller
{
	public function index ()
	{
		//access this from jQuery POST
		//POST fields should be
		//jobID -- jobID of the job to be added to schedule
		//scheduleDate -- the date of the schedule

		session_start();

		//checks if the type array key exists in SESSION
		//if it exists, it means that there is a user in session
		if(array_key_exists("type",$_SESSION)){

			//checks if the user in session is either a technician, admin, or super admin
			if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){

				//checks if jobPriority array key exists in POST
				if(array_key_exists("jobPriority",$_POST)){
					//checks if scheduleDate array key exists in POST
					if(array_key_exists("scheduleDate",$_POST)){
						//checks if jobID array key exists in POST
					  if(array_key_exists("jobID",$_POST)){

							//loads Code Igniter database module
							$this->load->database();

							//checks if the date is valid
							if($_POST["scheduleDate"] < $this->db->query("SELECT curdate()")->result_array()[0]["curdate()"]){
								echo "Invalid date";
								return;
							}

							$createdBy = 0;
							if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")) $createdBy = $this->db->query("SELECT adminID FROM adminAcc WHERE username='".$_SESSION["username"]."'")->result_array()[0]["adminID"];
							if($_SESSION["type"]==="superadmin") $createdBy = $this->db->query("SELECT superAdminID FROM superAdmin WHERE username='".$_SESSION["username"]."'")->result_array()[0]["superAdminID"];

							//inserts job to schedule
							$this->db->query("INSERT INTO schedule(priority,jobID,dateScheduled,dateCreated,createdBy,createdByType) VALUES (".$_POST["jobPriority"].",".$_POST["jobID"].",".$_POST["scheduleDate"].",CURDATE(),".$createdBy.",'".$_SESSION["type"]."')");
							//sets jobStatus to PROCESSING and the startDate from scheduleDate
							$this->db->query("UPDATE job SET jobStatus='PROCESSING', startDate='".$_POST["scheduleDate"]."', finishDate=NULL WHERE jobID=".$_POST["jobID"]."");
							//log these actions into USERLOGS
							$this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES('".$_SESSION["username"]." scheduled jobID #".$_POST["jobID"]." on ".date("F d, Y", strtotime($_POST["scheduleDate"]))."',CURRENT_TIMESTAMP)");

							if(count($this->db->query("SELECT jobID FROM schedule WHERE jobID=".$_POST["jobID"]."")->result_array())==1){
								echo "Added";
							}

							else{
								echo "Can not add";
							}
		        }
					}
				}
			}
		}

		else {

			$this->load->view('Login_view');
		}
	}
}
?>
