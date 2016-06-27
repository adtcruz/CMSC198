<?php

class View_user_logs_model extends CI_Model
{

	public function __construct ()
	{
		parent::__construct ();
		$this->load->database();
	}
  public function getLogEntries(){

		$query = $this->db->query(
			"SELECT logText, logTimestamp FROM userLogs ORDER BY logTimestamp DESC"
		);

		$row = $query->result_array();

		$logTable = "";

		if(count($row)>0){

			$this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table col s10 m10 l10">'));

			$this->table->set_heading("Log Entry","Timestamp");

			for($i = 0; $i < count($row); $i++){

				$this->table->add_row($row[$i]["logText"],$row[$i]["logTimestamp"]);
			}

			$logTable = $this->table->generate();
		}

		else $logTable = "<div class=\"col s10 m10 l10\"><h5 class=\"center-align\">Sorry, there are no recent log entries</h5></div>";

		return $logTable;
	}
}
?>
