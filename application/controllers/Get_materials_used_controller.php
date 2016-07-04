<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_materials_used_controller extends CI_Controller
{
	public function index ()
	{
		session_start();
		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

				if(array_key_exists("jobID",$_POST)){

					$this->load->database();

					$this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));

					$rows = $this->db->query('SELECT materialsUsed.materialsUsedID,materials.materialName,materialsUsed.materialUnits,materials.materialUnitMeasurement,materials.materialCost FROM materialsUsed,materials WHERE materialsUsed.jobID='.$_POST["jobID"].' AND materialsUsed.materialID = materials.materialID')->result_array();

					if(count($rows)==0){
						echo "<h5 class='center-align'>There are no materials used for this job yet.</h5>";
						return;
					}

					$this->table->set_heading("Material Name","Quantity/Units","Cost per unit","Total Cost","Actions");
					$this->load->model('Get_materials_used_model','gmum');

			    foreach($rows as $row){
							$actions = $this->gmum->processActions($row["materialsUsedID"]);
							$this->table->add_row($row["materialName"],$row["materialUnits"],$row["materialCost"]." per ".$row["materialUnitMeasurement"],($row["materialUnits"]*$row["materialCost"]),$actions);
			    }
			    echo $this->table->generate();
				}
			}
		}
	}
}
?>
