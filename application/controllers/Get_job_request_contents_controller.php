<?php
//this is the controller for the API that gets the job request contents
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_job_request_contents_controller extends CI_Controller
{
  public function index(){

    //session start to access session variables
    session_start();

    //loads the codeigniter database module
    $this->load->database();

    //checks if the type array key exists in session
    if(array_key_exists("type",$_SESSION)){

      //checks if jobID array key exists in POST
      if(array_key_exists("jobID",$_POST)){

        //gets the job description of the job
        $jobDesc = $this->db->query("SELECT jobDescription FROM job WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["jobDescription"];

        //gets the priority of the job
        $priority = $this->db->query("SELECT priority FROM schedule WHERE jobID=".$_POST["jobID"]."")->result_array()[0]["priority"];

        //loads the job request content
        $this->load->view('Job_request_content', array('jobDesc'=>$jobDesc, 'priority'=>$priority));
      }
    }
  }
}
