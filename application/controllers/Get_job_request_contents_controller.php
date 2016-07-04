<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_job_request_contents_controller extends CI_Controller
{
  public function index(){

    session_start();

    $this->load->database();

    if(array_key_exists("type",$_SESSION)){

      if(array_key_exists("jobID",$_POST)){

        $jobDesc = $this->db->query("SELECT jobDescription FROM job WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["jobDescription"];

        $priority = $this->db->query("SELECT priority FROM schedule WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["priority"];

        $this->load->view('Job_request_content', array('jobDesc'=>$jobDesc, 'priority'=>$priority));
      }
    }
  }
}
