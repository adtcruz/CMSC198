<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_requests_controller extends CI_Controller
{
  public function __construct() {
      parent:: __construct();
      //$this->load->library("pagination");
      $this->load->model('Job_requests_model','jrm');
      $this->load->model ('Notifications_model', 'nm');
  }

	public function index ()
	{
		session_start();
        $options = "";
		if(array_key_exists("type",$_SESSION)){
            $tabl = "";
            $unread = "";

            $this->table->clear ();
        	$this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));

			if($_SESSION["type"] === "client"){

				//gets the client ID
				$clientID = $this->jrm->getUserID();

				//queries the DB
				$rows1 = $this->jrm->getJobRequestsArray(" WHERE clientID=".$clientID." ");

				$nRows1 = count($rows1);

				if($nRows1 == 0){
					$tabl = "<h5 class=\"center-align\">Sorry, there are no job requests filed under your name at the moment.</h5>";
					$this->load->view('Job_requests_view', array('table' => $tabl));
					return;
				}

                //table heading
				$this->table->set_heading("Description","Start Date","Finish Date","Status","Date Filed","Actions");

				for ($i = 0; $i < $nRows1; $i++){

					$startDate = $this->jrm->processDate($rows1[$i]["startDate"]);

					$finishDate = $this->jrm->processDate($rows1[$i]["finishDate"]);

					$jobStatus = $this->jrm->processJobStatus($rows1[$i]["jobStatus"]);

					$actions = $this->jrm->getJobActions($rows1[$i],$clientID);

					//date filed column entry
					$dateFiled = $this->jrm->processDate($rows1[$i]["dateCreated"]);

					$this->table->add_row($rows1[$i]["jobDescription"],$startDate,$finishDate,$jobStatus,$dateFiled,$actions);
				}

                $unread = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
                $tabl = $this->table->generate();
			}

			else if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){

				//loads Code Igniter database module
				$this->load->database();

				$rows1 = $this->jrm->getJobRequestsArray(" ");
				$nRows1 = count($rows1);

				if($nRows1 == 0){
					$tabl = "<h5 class=\"center-align\">Sorry, there are no job requests at the moment.</h5>";
					$this->load->view('Job_requests_view', array('table' => $tabl));
					return;
				}

                $this->table->set_heading('Description','Client','Start Date','Finish Date','Status','Date Filed','Filed By','Actions');

				for ($i = 0; $i < $nRows1; $i++){

					$userID = $this->jrm->getUserID();

					$clientName = $this->jrm->getClientName($rows1[$i]["clientID"]);

					$startDate = $this->jrm->processDate($rows1[$i]["startDate"]);

					$finishDate = $this->jrm->processDate($rows1[$i]["finishDate"]);

					$jobStatus = $this->jrm->processJobStatus($rows1[$i]["jobStatus"]);

					$actions = $this->jrm->getJobActions($rows1[$i],$userID);

					//date filed column entry
					$dateFiled = $this->jrm->processDate($rows1[$i]["dateCreated"]);

					$filedBy = $this->jrm->getFiledBy($rows1[$i]);

					$this->table->add_row($rows1[$i]["jobDescription"],$clientName,$startDate,$finishDate,$jobStatus,$dateFiled,$filedBy,$actions);

				}

                $unread = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
                $tabl = $this->table->generate();
			}

            $unread = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
            $options = $this->jrm->getOffices($_SESSION["type"]);
			$this->load->view('Job_requests_view', array('table' => $tabl, 'options' => $options, 'unread' => $unread));
		}

    else{

			$this->load->view('Login_view');
		}
	}
}
?>
