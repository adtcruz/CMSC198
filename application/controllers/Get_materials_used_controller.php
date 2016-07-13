<?php
//this is the controller for the API that gets the table of materials used in a job
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_materials_used_controller extends CI_Controller
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
					$rows = $this->db->query('SELECT materialsUsed.materialsUsedID,materials.materialName,materialsUsed.materialUnits,materials.materialUnitMeasurement,materials.materialCost FROM materialsUsed,materials WHERE materialsUsed.jobID='.$_POST["jobID"].' AND materialsUsed.materialID = materials.materialID')->result_array();

					//if there are no results, return a message instead
					if(count($rows)==0){
						echo "<h5 class='center-align'>There are no materials used for this job yet.</h5>";
						return;
					}

					//sets table heading
					$this->table->set_heading("Material Name","Quantity/Units","Cost per unit","Total Cost","Actions");

					//loads model to access function to process action buttons
					$this->load->model('Get_materials_used_model','gmum');

			    foreach($rows as $row){
						
							//process the action buttons for this row
							$actions = $this->gmum->processActions($row["materialsUsedID"]);

							//adds the row to the table
							$this->table->add_row($row["materialName"],$row["materialUnits"],$row["materialCost"]." per ".$row["materialUnitMeasurement"],($row["materialUnits"]*$row["materialCost"]),$actions);
			    }

					//return the table generated
			    echo $this->table->generate();
				}
			}
		}
	}
}
?>
