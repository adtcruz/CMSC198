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

					$rows = $this->db->query('SELECT workDone.workDoneID,work.workDescription,work.workDuration,work.workCost FROM workDone,work WHERE workDone.jobID='.$_POST["jobID"].' AND workDone.workID = work.workID')->result_array();

					if(count($rows)==0){
						echo "<h5 class='center-align'>There are no work done for this job yet.</h5>";
						return;
					}

					$this->table->set_heading("Work Description","Rate","Total Cost","Actions");
					//$this->load->model('Get_materials_used_model','gmum');

			    foreach($rows as $row){
							//$actions = $this->gmum->processActions($row["materialsUsedID"]);
							$this->table->add_row($row["workDescription"],$row["workCost"]." per hour",($row["workDuration"]*$row["workCost"]),"actions");
			    }
			    echo $this->table->generate();
				}
			}
		}
	}
}
?>
