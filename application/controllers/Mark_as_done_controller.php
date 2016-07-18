<?php
//this is the controller for the API that marks a job request as done/processed
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mark_as_done_controller extends CI_Controller
{
  public function index(){

    //session start to access session variables
    session_start();

    //loads code igniter database module
    $this->load->database();

    //checks if type array key exists in session
    //if it does it means that there is a user in session
    if(array_key_exists("type",$_SESSION)){

      //checks if the user in session is a technician or superadmin
      if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="superadmin")){

        //checks if isDone array key exists in post
        if(array_key_exists("isDone",$_POST)){

          //checks if jobID array key exists in post
          if(array_key_exists("jobID",$_POST)){

            //if isDone is yes
            if($_POST["isDone"]==="yes"){

              //sets jobStatus as processed
              $this->db->query("UPDATE job SET jobStatus='PROCESSED', finishDate=CURDATE() WHERE jobID=".$_POST["jobID"]."");

              //delete the job from schedule table
              $this->db->query("DELETE FROM schedule WHERE jobID=".$_POST["jobID"]."");

              //record this action to logs
              $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." marked jobID #".$_POST["jobID"]." as done',CURRENT_TIMESTAMP)");

              //insert to notification
              $query = $this->db->query ('SELECT job.jobDescription, job.clientID FROM job WHERE (job.jobID = '.$_POST['jobID'].')');

              $jobDescription = $query->result_array ()[0]['jobDescription'];
              $clientID = $query->result_array ()[0]['clientID'];
              $userID = "";

              if ($_SESSION['type'] === 'technician')
              {
                  $query = $this->db->query ('SELECT adminAcc.adminID FROM adminAcc WHER (adminAcc.username = "'.$_SESSION['username'].'")');
                  $userID = $query->result_array ()[0]['adminID'];
              }
              if ($_SESSION['type'] === 'superadmin')
              {
                  $query = $this->db->query ('SELECT superAdmin.superAdminID FROM adminAcc WHER (superAdmin.username = "'.$_SESSION['username'].'")');
                  $userID = $query->result_array ()[0]['superAdminID'];
              }

              $this->db->query ('SELECT notifications.clientID, notifications.jobID, notifications.createdBy, notifications.createdByType FROM notifications WHERE (notifications.clientID = '..$clientID') AND (notifications.jobID = '.$_POST['jobID'].') AND (notifications.createdBy = '.$userID.') AND (notifications.createdByType = '.$_POST['type'].')');

              if ($this->db->affected_rows () > 0)
              {
                  return;
              }
              else
              {
                  $this->db->query ('INSERT INTO notifications (notifText, clientID, jobID, dateCreated, createdBy, createdByType) VALUES ("Job Request ('.$jobDescription.') is done", '.$clientID.', '.$_POST['jobID'].', CURDATE(), '.$userID.')');  
              }

              //sends a message that job is marked as done
              echo "Marked as done";

              //preterminates the execution of the script
              return;
            }
          }
        }

      }

      else{

        $this->load->view('Login_view');
      }
    }
  }
}
?>
