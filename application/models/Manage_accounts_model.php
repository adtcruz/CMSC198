<?php

class Manage_accounts_model extends CI_Model
{

	public function __construct ()
	{
		parent::__construct ();
		$this->load->database();
	}

	public function processActive($row)
	{
		if($row["active"]==1) return "YES";
		else return "NO";
	}

	public function getAllUsersTable()
	{
		$this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));
		$this->table->set_heading("Username","Given Name", "Last Name", "Active?");
		$query = $this->db->query("SELECT username,givenName,lastName,active FROM client UNION SELECT username,givenName,lastName,active FROM adminAcc UNION SELECT username,givenName,lastName,active FROM superAdmin ORDER BY username");
		$rows = $query->result_array();

		foreach ($rows as $row) {
			$activeStatus = $this->processActive($row);
			$this->table->add_row($row["username"],$row["givenName"],$row["lastName"],$activeStatus);
		}
		return $this->table->generate();
	}

	public function getClientsTable()
	{
		$this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));
		$this->table->set_heading("Username","Given Name", "Last Name","Active?");
		$query = $this->db->query("SELECT username,givenName,lastName,active FROM client");
		$rows = $query->result_array();

		if(count($rows)==0) return "<h5 class=\"center-align\">Sorry, there are no Client Users at the moment.</h5>";

		foreach ($rows as $row) {
			$activeStatus = $this->processActive($row);
			$this->table->add_row($row["username"],$row["givenName"],$row["lastName"],$activeStatus);
		}
		return $this->table->generate();
	}

	public function getAdminsTable()
	{
		$this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));
		$this->table->set_heading("Username","Given Name", "Last Name","Active?");
		$query = $this->db->query("SELECT username,givenName,lastName,active FROM adminAcc WHERE isTechnician=0");
		$rows = $query->result_array();

		if(count($rows)==0) return "<h5 class=\"center-align\">Sorry, there are no Admin Users at the moment.</h5>";

		foreach ($rows as $row) {
			$activeStatus = $this->processActive($row);
			$this->table->add_row($row["username"],$row["givenName"],$row["lastName"],$activeStatus);
		}
		return $this->table->generate();
	}

	public function getTechniciansTable()
	{
		$this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));
		$this->table->set_heading("Username","Given Name", "Last Name", "Active?");
		$query = $this->db->query("SELECT username,givenName,lastName,active FROM adminAcc WHERE isTechnician=1");
		$rows = $query->result_array();

		if(count($rows)==0) return "<h5 class=\"center-align\">Sorry, there are no Technician Users at the moment.</h5>";

		foreach ($rows as $row) {
			$activeStatus = $this->processActive($row);
			$this->table->add_row($row["username"],$row["givenName"],$row["lastName"],$activeStatus);
		}
		return $this->table->generate();
	}

	public function getSuperadminsTable()
	{
		$this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));
		$this->table->set_heading("Username","Given Name", "Last Name","Active?");
		$query = $this->db->query("SELECT username,givenName,lastName,active FROM superAdmin");
		$rows = $query->result_array();

		if(count($rows)==0) return "<h5 class=\"center-align\">Sorry, there are no Super Admins at the moment.</h5>";

		foreach ($rows as $row) {
			$activeStatus = $this->processActive($row);
			$this->table->add_row($row["username"],$row["givenName"],$row["lastName"],$activeStatus);
		}
		return $this->table->generate();
	}

}
?>
