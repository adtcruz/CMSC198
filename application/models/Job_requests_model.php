<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Job_requests_model extends CI_Model
{
	public $db_data;
	public function __construct ()
	{
		parent::__construct ();
		$this->load->database();
	}

	public function processOffices($officeID, $space)
    {
		$query = $this->db->query('SELECT office.officeID, office.officeName, office.parentUnit, office.officeAbbr FROM office WHERE (office.parentUnit = '.$officeID.') ORDER BY office.officeName');
        global $db_data;
        $db_data['parent'.$officeID.''] = $query->result_array ();
        if (!empty ($db_data['parent'.$officeID.'']))
        {
            $space++;
            foreach ($db_data['parent'.$officeID.''] as $row)
            {
                if ($space == 1)
                {
                    $cell = array (
                        'data' => '<option value = "'.$row['officeID'].'">'.str_repeat ('&nbsp;', $space).$row['officeName'].'</option>'
                    );
                }
                else
                {
                    $cell = array (
                        'data' => '<option value = "'.$row['officeID'].'">'.str_repeat ('-&nbsp;', $space).$row['officeName'].'</option>'
                    );
                }
                $this->table->add_row ($cell);
                $this->processOffices($row['officeID'], $space);
            }
        }
	}

  public function getOffices($type){

		$options = "";

    if(($type==="technician")||($type==="admin")||($type==="superadmin")){
			$this->processOffices(0, 0);

			$template = array (
        'table_open' => '',
        'tbody_open' => '',
        'tbody_close' => '',
        'row_start' => '',
        'row_end' => '',
        'cell_start' => '',
        'cell_end' => '',
        'row_alt_start' => '',
        'row_alt_end' => '',
        'cell_alt_start' => '',
        'cell_alt_end' => '',
        'table_close' => ''
	    );
	    $this->table->set_template($template);
	    $options = $this->table->generate();
    }

		return $options;
  }

	public function processSearch($key)
	{
			$searchString = "";
			$keys = preg_split("/[\s]/",$key);
			foreach ($keys as $key){
				if ($searchString!=="") $searchString = $searchString . " AND";
				$searchString = $searchString . " jobDescription LIKE '%".$key."%'";
			}
			return $searchString;
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
				$actions = "<a class=\"btn-floating btn tooltipped waves-effect waves-light green\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Schedule job\" onclick=\"openScheduleJob('".base_url()."',".$jobID.");\"><i class=\"material-icons\">query_builder</i></a>&nbsp;&nbsp;";
				$actions = $actions . "<a class=\"btn-floating btn tooltipped waves-effect waves-light cyan\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Edit Job Description\" onclick=\"openEditModal('".base_url()."',".$jobID.");\"><i class=\"material-icons\">mode_edit</i></a>&nbsp;&nbsp;";
				return $actions . "<a class=\"btn-floating btn tooltipped waves-effect waves-light red\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Cancel Job Request\" onclick=\"confirmCancel(".$jobID.");\"><i class=\"material-icons\">not_interested</i></a>";
			}

			//admins and technicians can schedule job requests
			if(($_SESSION["type"]==="admin")||($_SESSION["type"]==="technician")){
				$actions = "<a class=\"btn-floating btn tooltipped waves-effect waves-light green\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Schedule job\" onclick=\"openScheduleJob('".base_url()."',".$jobID.");\"><i class=\"material-icons\">query_builder</i></a>&nbsp;&nbsp;";
			}

			//users can only edit or cancel job requests that they filed
			if($_SESSION["type"]===$createdByType){
				if($userID == $createdBy){
					$actions = $actions . "<a class=\"btn-floating btn tooltipped waves-effect waves-light cyan\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Edit Job Description\" onclick=\"openEditModal('".base_url()."',".$jobID.");\"><i class=\"material-icons\">mode_edit</i></a>&nbsp;&nbsp;";
					$actions = $actions . "<a class=\"btn-floating btn tooltipped waves-effect waves-light red\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Cancel Job Request\" onclick=\"confirmCancel(".$jobID.");\"><i class=\"material-icons\">not_interested</i></a>";
				}
			}
			return $actions;
		}
		else if($jobStatus === "PROCESSING"){

			$actions = "";

			//superadmins may edit or cancel job requests that are processing
			//they may also update job requests (i.e. add work done and materials used)
			if($_SESSION["type"]==="superadmin"){
				$actions = $actions . "<a class=\"btn-floating btn tooltipped waves-effect waves-light yellow darken-3\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"View Job Request\" onclick=\"getJobRequestContents('".base_url()."',".$jobID.");\"><i class=\"material-icons\">assignment</i></a>&nbsp;&nbsp;";
				$actions = $actions . "<a class=\"btn-floating btn tooltipped waves-effect waves-light cyan\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Edit Job Description\" onclick=\"openEditModal('".base_url()."',".$jobID.");\"><i class=\"material-icons\">mode_edit</i></a>&nbsp;&nbsp;";
				return $actions . "<a class=\"btn-floating btn tooltipped waves-effect waves-light red\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"Cancel Job Request\" onclick=\"confirmCancel(".$jobID.");\"><i class=\"material-icons\">not_interested</i></a>";
			}

			//technicians may update job requests (i.e. add work done and materials used)
			if ($_SESSION["type"]==="technician"){
				return "<a class=\"btn-floating btn tooltipped waves-effect waves-light yellow darken-3\" data-position=\"left\" data-delay=\"50\" data-tooltip=\"View Job Request\" onclick=\"getJobRequestContents('".base_url()."',".$jobID.");\"><i class=\"material-icons\">assignment</i></a>&nbsp;&nbsp;";
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
