<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_work_done_controller extends CI_Controller
{
	public function index ()
	{
		session_start();
		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				if(array_key_exists("jobID",$_POST)){

					$this->load->database();

					$this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));

					$rows = $this->db->query('SELECT workDone.workDoneID,work.workDescription,workDone.workDuration,work.workCost FROM workDone,work WHERE workDone.jobID='.$_POST["jobID"].' AND workDone.workID = work.workID')->result_array();

					if(count($rows)==0){
						echo "<h5 class='center-align'>There are no work done for this job yet.</h5>";
						return;
					}

					$this->table->set_heading("Work Description","Rate","Total Cost","Actions");
					$this->load->model('Get_work_done_model','gwdm');

			    foreach($rows as $row){
							$actions = $this->gwdm->processActions($row["workDoneID"]);
							$rate = $this->gwdm->processRate($row["workCost"]);
							$cost = $this->gwdm->processCost($row["workCost"],$row["workDuration"]);
							$this->table->add_row($row["workDescription"],$rate,$cost,$actions);
			    }
			    echo $this->table->generate();
				}
			}
		}
	}
}
?>
