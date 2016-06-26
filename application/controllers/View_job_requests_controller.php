<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View_job_requests_controller extends CI_Controller
{
	public function index ()
	{
		//starts session
		session_start();
		if(array_key_exists("type",$_SESSION)){
			$tabl = "";

			$this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));

			$this->load->model('View_job_requests_model','vjrm');

			if($_SESSION["type"] === "client"){

				//gets the client ID
				$clientID = $this->vjrm->getUserID();

				//queries the DB
				$rows1 = $this->vjrm->getJobRequestsArray(" WHERE clientID=".$clientID." ");

				$nRows1 = count($rows1);

				if($nRows1 == 0){
					$tabl = "<h5 class=\"center-align\">Sorry, there are no job requests filed under your name at the moment.</h5>";
					$this->load->view('View_job_requests_view', array('table' => $tabl));
					return;
				}

				//table heading
				$this->table->set_heading("Description","Start Date","Finish Date","Status","Date Filed","Actions");

				for ($i = 0; $i < $nRows1; $i++){

					$startDate = $this->vjrm->processDate($rows1[$i]["startDate"]);

					$finishDate = $this->vjrm->processDate($rows1[$i]["finishDate"]);

					$jobStatus = $this->vjrm->processJobStatus($rows1[$i]["jobStatus"]);

					$actions = $this->vjrm->getJobActions($rows1[$i],$clientID);

					//date filed column entry
					$dateFiled = $this->vjrm->processDate($rows1[$i]["dateCreated"]);

					$this->table->add_row($rows1[$i]["jobDescription"],$startDate,$finishDate,$jobStatus,$dateFiled,$actions);
				}

			}

			else if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){

				//loads Code Igniter database module
				$this->load->database();

				$rows1 = $this->vjrm->getJobRequestsArray(" ");
				$nRows1 = count($rows1);

				if($nRows1 == 0){
					$tabl = "<h5 class=\"center-align\">Sorry, there are no job requests at the moment.</h5>";
					$this->load->view('View_job_requests_view', array('table' => $tabl));
					return;
				}

				$this->table->set_heading('Description','Client','Start Date','Finish Date','Status','Date Filed','Filed By','Actions');

				for ($i = 0; $i < $nRows1; $i++){

					$userID = $this->vjrm->getUserID();

					$clientName = $this->vjrm->getClientName($rows1[$i]["clientID"]);

					$startDate = $this->vjrm->processDate($rows1[$i]["startDate"]);

					$finishDate = $this->vjrm->processDate($rows1[$i]["finishDate"]);

					$jobStatus = $this->vjrm->processJobStatus($rows1[$i]["jobStatus"]);

					$actions = $this->vjrm->getJobActions($rows1[$i],$userID);

					//date filed column entry
					$dateFiled = $this->vjrm->processDate($rows1[$i]["dateCreated"]);

					$filedBy = $this->vjrm->getFiledBy($rows1[$i]);

					$this->table->add_row($rows1[$i]["jobDescription"],$clientName,$startDate,$finishDate,$jobStatus,$dateFiled,$filedBy,$actions);

				}
			}

			$tabl = $this->table->generate();
			$this->load->view('View_job_requests_view', array('table' => $tabl));
		}
		else {
			die("You are not logged-in");
		}

	}
}
?>
