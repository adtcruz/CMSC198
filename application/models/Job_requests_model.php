<?php

class Job_requests_model extends CI_Model
{

	public function __construct ()
	{
		parent::__construct ();
		$this->load->database();
	}

  public function getOffices($type){

		$options = "";

    if(($type==="technician")||($type==="admin")||($type==="superadmin")){

      //queries the database for officeIDs and officeNames
      $query = $this->db->query("SELECT officeID, officeName FROM office ORDER BY officeName");

      //gets the results in easy-to-use array form
      $rows = $query->result_array();

      $options = "<option value=\"\" selected=\"selected\" disabled=\"disabled\">Select office…</option>";

      for($i = 0; $i < count($rows); $i++){
        $options = $options."<option value=\"".$rows[$i]["officeID"]."\">".$rows[$i]["officeName"]."</option>";
      }
    }

		return $options;
  }

	public function getJobRequestsArray($whereClause)
	{
		$query = $this->db->query(
			"SELECT jobID, jobDescription, startDate, finishDate, jobStatus, ".
			"clientID, adminID, dateCreated, createdBy, createdByType FROM job".
			$whereClause."ORDER BY dateCreated DESC, jobID DESC"
		);
		return $query->result_array();
	}

	public function processDate($dateToProcess)
	{
		if($dateToProcess===NULL){
			return "";
		}
		else{
			return date("F d, Y", strtotime($dateToProcess));
		}
	}

	public function getUserID()
	{
		if($_SESSION["type"]==="superadmin"){
			$query = $this->db->query(
				"SELECT superAdminID FROM superAdmin WHERE username='".$_SESSION["username"]."'"
			);
			return $query->result_array()[0]["superAdminID"];
		}
		if(($_SESSION["type"]==="admin")||($_SESSION["type"]==="technician")){
			$query = $this->db->query(
				"SELECT adminID FROM adminAcc WHERE username='".$_SESSION["username"]."'"
			);
			return $query->result_array()[0]["adminID"];
		}
		if($_SESSION["type"]==="client"){
			$query = $this->db->query(
				"SELECT clientID FROM client WHERE username='".$_SESSION["username"]."'"
			);
			return $query->result_array()[0]["clientID"];
		}
	}

	public function getClientName($clientID)
	{
		$query = $this->db->query(
			"SELECT givenName, lastName FROM client WHERE clientID=".$clientID.""
		);
		$rows = $query->result_array();

		return $rows[0]["givenName"]." ".$rows[0]["lastName"];
	}

	public function getFiledBy($currentRow)
	{
		if ($currentRow["createdByType"] === "client"){
			$query = $this->db->query("SELECT givenName, lastName FROM client WHERE clientID=".$currentRow["clientID"]."");
			$rows = $query->result_array();

			return $rows[0]["givenName"]." ".$rows[0]["lastName"];
		}
		else if (($currentRow["createdByType"] === "technician")||($currentRow["createdByType"] === "admin")){
			$query = $this->db->query("SELECT givenName, lastName FROM adminAcc WHERE adminID=".$currentRow["createdBy"]."");
			$rows = $query->result_array();

			return $rows[0]["givenName"]." ".$rows[0]["lastName"];
		}
		else if ($currentRow["createdByType"] === "superadmin"){
			$query = $this->db->query("SELECT givenName, lastName FROM superAdmin WHERE superAdminID=".$currentRow["createdBy"]."");
			$rows = $query->result_array();

			return $rows[0]["givenName"]." ".$rows[0]["lastName"];
		}
	}

	public function processJobStatus($jobStatus)
	{
		if($jobStatus === "PENDING"){
			return "<span class=\"blue-text\">".$jobStatus."</span>";
		}
		else if($jobStatus === "PROCESSING"){
			return "<span class=\"orange-text\">".$jobStatus."</span>";
		}
		else if($jobStatus === "CANCELED"){
			return "<span class=\"red-text\">".$jobStatus."</span>";
		}
		else if($jobStatus === "PROCESSED"){
			return "<span class=\"green-text\">".$jobStatus."</span>";
		}
	}

	public function getJobActions($currentRow,$userID)
	{
		$jobID = $currentRow["jobID"];
		$jobStatus = $currentRow["jobStatus"];
		$createdBy = $currentRow["createdBy"];
		$createdByType = $currentRow["createdByType"];

		if($jobStatus === "PENDING"){

			$actions = "";

			//superadmins may schedule, edit, or cancel job requests
			if($_SESSION["type"]==="superadmin"){
				$actions = "<a class=\"btn-floating btn tooltipped waves-effect waves-light green\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Schedule job\" onclick=\"openScheduleJob('".base_url()."',".$jobID.");\"><i class=\"material-icons\">assignment</i></a>&nbsp;&nbsp;";
				$actions = $actions . "<a class=\"btn-floating btn tooltipped waves-effect waves-light cyan\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Edit Job Request Details\" onclick=\"openEditModal('".base_url()."',".$jobID.");\"><i class=\"material-icons\">mode_edit</i></a>&nbsp;&nbsp;";
				return $actions . "<a class=\"btn-floating btn tooltipped waves-effect waves-light red\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Cancel Job Request\" onclick=\"confirmCancel(".$jobID.");\"><i class=\"material-icons\">not_interested</i></a>";
			}

			//admins and technicians can schedule job requests
			if(($_SESSION["type"]==="admin")||($_SESSION["type"]==="technician")){
				$actions = "<a class=\"btn-floating btn tooltipped waves-effect waves-light green\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Schedule job\" onclick=\"openScheduleJob('".base_url()."',".$jobID.");\"><i class=\"material-icons\">assignment</i></a>&nbsp;&nbsp;";
			}

			//users can only edit or cancel job requests that they filed
			if($_SESSION["type"]===$createdByType){
				if($userID == $createdBy){
					$actions = $actions . "<a class=\"btn-floating btn tooltipped waves-effect waves-light cyan\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Edit Job Request Details\" onclick=\"openEditModal('".base_url()."',".$jobID.");\"><i class=\"material-icons\">mode_edit</i></a>&nbsp;&nbsp;";
					$actions = $actions . "<a class=\"btn-floating btn tooltipped waves-effect waves-light red\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Cancel Job Request\" onclick=\"confirmCancel(".$jobID.");\"><i class=\"material-icons\">not_interested</i></a>";
				}
			}
			return $actions;
		}
		else if($jobStatus === "PROCESSING"){

			$actions = "";

			//superadmins may edit or cancel job requests that are processing
			if($_SESSION["type"]==="superadmin"){
				$actions = $actions . "<a class=\"btn-floating btn tooltipped waves-effect waves-light cyan\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Edit Job Request\" onclick=\"openEditModal(".$jobID.");\"><i class=\"material-icons\">mode_edit</i></a>&nbsp;&nbsp;";
				return $actions . "<a class=\"btn-floating btn tooltipped waves-effect waves-light red\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Cancel Job Request\" onclick=\"confirmCancel(".$jobID.");\"><i class=\"material-icons\">not_interested</i></a>";
			}
		}
		//no actions can be made if job request was already processed or cancelled
		else if($jobStatus === "CANCELED"){
			return "";
		}
		else if($jobStatus === "PROCESSED"){
			return "";
		}
	}
}
?>
