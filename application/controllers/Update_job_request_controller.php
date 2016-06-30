<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_job_request_controller extends CI_Controller
{
  public function index(){

    session_start();

    $this->load->database();

    if(array_key_exists("type",$_SESSION)){

      if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="superadmin")){

        if(array_key_exists("isDone",$_POST)){

          if(array_key_exists("jobID",$_POST)){
            if($_POST["isDone"]==="yes"){
              $this->db->query("UPDATE job SET jobStatus='PROCESSED', finishDate=CURDATE() WHERE jobID=".$_POST["jobID"]."");
              $this->db->query("DELETE FROM schedule WHERE jobID=".$_POST["jobID"]."");
              $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." marked jobID #".$_POST["jobID"]." as done',CURRENT_TIMESTAMP)");
              echo "Marked as done";
              return;
            }
          }
        }

        if(array_key_exists("jobID",$_POST)){

          $jobDesc = $this->db->query("SELECT jobDescription FROM job WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["jobDescription"];
          $this->load->view('Update_job_request_content', array('jobDesc'=>$jobDesc));
        }

        else{
          redirect('job_requests');
        }
      }

      else{

        $this->load->view('Login_view');
      }
    }
  }
}
?>
