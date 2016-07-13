<?php
//this is the controller for the API that gets the table of work done in a job
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_work_done_controller extends CI_Controller
{
	public function index ()
	{
		//session start to access session variables
		session_start();

		//checks if type array key exist in session
		if(array_key_exists("type",$_SESSION)){

			//checks if the user in session is either a superadmin or technician
			//data is only accessible to superadmins and technicians
			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				//checks if jobID array key exists in POST
				if(array_key_exists("jobID",$_POST)){

					//loads codeigniter database module
					$this->load->database();

					//sets the table template
					$this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));

					//queries the database
					$rows = $this->db->query('SELECT workDone.workDoneID,work.workDescription,workDone.workDuration,work.workCost FROM workDone,work WHERE workDone.jobID='.$_POST["jobID"].' AND workDone.workID = work.workID')->result_array();

					//if there are no results, return a message instead
					if(count($rows)==0){
						echo "<h5 class='center-align'>There are no work(s) done for this job yet.</h5>";
						return;
					}

					//sets table heading
					$this->table->set_heading("Work Description","Rate","Total Cost","Actions");

					//loads model to access function to process action buttons
					$this->load->model('Get_work_done_model','gwdm');

			    foreach($rows as $row){

						//process the action buttons for this row
						$actions = $this->gwdm->processActions($row["workDoneID"]);

						//process the rate entry
						$rate = $this->gwdm->processRate($row["workCost"]);

						//process the cost entry
						$cost = $this->gwdm->processCost($row["workCost"],$row["workDuration"]);

						//add a row to the table
						$this->table->add_row($row["workDescription"],$rate,$cost,$actions);
			    }

					//return the generated table
			    echo $this->table->generate();
				}
			}
		}
	}
}
?>
