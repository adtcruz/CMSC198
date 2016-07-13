<?php
//this is the controller for the API that marks a job request as done/processed
defined('BASEPATH') OR exit('No direct script access allowed');

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
