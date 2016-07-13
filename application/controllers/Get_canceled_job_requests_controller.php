<?php
//this is the controller for the API that gets the canceled job requests table
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_canceled_job_requests_controller extends CI_Controller
{
  public function __construct() {
      parent:: __construct();

      //loads the job requests model to access the functions needed for the table generation
      $this->load->model('Job_requests_model','jrm');
  }

	public function index ()
	{
    //session start to access session variables
		session_start();

    //explicit initialisation of the options variable
    $options = "";

    //checks if the type array key exists in session
    //if it does it means that there is a user currently in session
		if(array_key_exists("type",$_SESSION)){

      //explicit initialisation of the tabl varaible
      $tabl = "";

      //sets the template of the table
			$this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));

      //if the user in session is a client
      if($_SESSION["type"] === "client"){

				//gets the client ID
				$clientID = $this->jrm->getUserID();

				//queries the DB
				$rows1 = $this->jrm->getJobRequestsArray(" WHERE jobStatus='CANCELED' AND clientID=".$clientID." ");

        //gets the number of rows
				$nRows1 = count($rows1);

        //if the number of rows is zero, it means that there are no job requests filed under the client's name
        //returns a message instead of a table
				if($nRows1 == 0){
					echo "<h5 class=\"center-align\">Sorry, there are no canceled job requests filed under your name at the moment.</h5>";
					return;
				}

				//table heading
				$this->table->set_heading("Description","Start Date","Finish Date","Status","Date Filed","Actions");

				for ($i = 0; $i < $nRows1; $i++){

          //processes the start date entry
					$startDate = $this->jrm->processDate($rows1[$i]["startDate"]);

          //processes the finish date entry
					$finishDate = $this->jrm->processDate($rows1[$i]["finishDate"]);

          //processes the job status entry
					$jobStatus = $this->jrm->processJobStatus($rows1[$i]["jobStatus"]);

          //processes the actions buttons
					$actions = $this->jrm->getJobActions($rows1[$i],$clientID);

					//date filed column entry
					$dateFiled = $this->jrm->processDate($rows1[$i]["dateCreated"]);

          //adds a row to the table
					$this->table->add_row($rows1[$i]["jobDescription"],$startDate,$finishDate,$jobStatus,$dateFiled,$actions);
				}

			}

			else if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){

				//loads Code Igniter database module
				$this->load->database();

        //queries the DB
				$rows1 = $this->jrm->getJobRequestsArray(" WHERE jobStatus='CANCELED'");

        //gets the number of rows
				$nRows1 = count($rows1);

        //if the number of rows is zero, it means that there are no job requests filed under the client's name
        //returns a message instead of a table
				if($nRows1 == 0){
					echo "<h5 class=\"center-align\">Sorry, there are no canceled job requests at the moment.</h5>";
					return;
				}

        //sets the table heading
				$this->table->set_heading('Description','Client','Start Date','Finish Date','Status','Date Filed','Filed By','Actions');

				for ($i = 0; $i < $nRows1; $i++){

          //gets the userID of the user in session
					$userID = $this->jrm->getUserID();

          //gets the client name
					$clientName = $this->jrm->getClientName($rows1[$i]["clientID"]);

          //processes the start date
					$startDate = $this->jrm->processDate($rows1[$i]["startDate"]);

          //processes the finish date
					$finishDate = $this->jrm->processDate($rows1[$i]["finishDate"]);

          //processes the job status
					$jobStatus = $this->jrm->processJobStatus($rows1[$i]["jobStatus"]);

          //processes the actions buttons
					$actions = $this->jrm->getJobActions($rows1[$i],$userID);

					//date filed column entry
					$dateFiled = $this->jrm->processDate($rows1[$i]["dateCreated"]);

          //processes the filedBy column entry
					$filedBy = $this->jrm->getFiledBy($rows1[$i]);

          //adds a row to the table
					$this->table->add_row($rows1[$i]["jobDescription"],$clientName,$startDate,$finishDate,$jobStatus,$dateFiled,$filedBy,$actions);

				}
			}

      //returns the table generated
			echo $this->table->generate();
      return;
		}

    else{

			$this->load->view('Login_view');
		}
	}
}
?>
