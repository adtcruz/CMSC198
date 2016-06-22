<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class View_jobs_controller extends CI_Controller
{
	public function index ()
	{
		//starts session
		session_start();
		if(array_key_exists("type",$_SESSION)){
			$tabl = "";
			
			$this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));
			
			if($_SESSION["type"] === "client"){
				
				//loads Code Igniter database module
				$this->load->database();
				
				//table heading
				$this->table->set_heading("Description","Start Date","Finish Date","Status","Techinician","Date Filed","Actions");
				
				//queries the database for the client ID of the user in session
				$query = $this->db->query("SELECT clientID FROM client WHERE username='".$_SESSION["username"]."'");
				
				//gets the results in easy-to-use array form
				$rows = $query->result_array();
				//gets the client ID
				$clientID = $rows[0]["clientID"];
				
				//queries the DB
				$query1 = $this->db->query(
					"SELECT jobID, jobDescription, startDate, finishDate, jobStatus, adminID, dateCreated FROM job WHERE clientID=".$clientID." ORDER BY jobID DESC"
				);
				
				//gets the results in easy-to-use array form
				$rows1 = $query1->result_array();
				
				$nRows1 = count($rows1);
				
				for ($i = 0; $i < $nRows1; $i++){
					
					$startDate = "";
					//start date column entry
					if($rows1[$i]["startDate"] !== NULL){
						$startDate = date("F d, Y", strtotime($rows1[$i]["startDate"]));
					}
					
					$finishDate = "";
					//finish date column entry
					if($rows1[$i]["startDate"] !== NULL){
						$finishDate = date("F d, Y", strtotime($rows1[$i]["finishDate"]));
					}
					
					$jobStatus = "";
					$actions = "";
					//job status column entry
					if($rows1[$i]["jobStatus"] === "PENDING"){
						$jobStatus = "<span class=\"blue-text\">".$rows1[$i]["jobStatus"]."</span>";
						$actions = "<a class=\"btn-floating btn waves-effect waves-light cyan\"><i class=\"material-icons\">mode_edit</i></a>";
						$actions = $actions . "&nbsp;&nbsp;&nbsp;&nbsp;" . "<a class=\"btn-floating btn waves-effect waves-light red\" onclick=\"confirmCancel(".$rows1[$i]["jobID"].");\"><i class=\"material-icons\">not_interested</i></a>";
					}
					else if($rows1[$i]["jobStatus"] === "PROCESSING"){
						$jobStatus = "<span class=\"orange-text\">".$rows1[$i]["jobStatus"]."</span>";
					}
					else if($rows1[$i]["jobStatus"] === "CANCELED"){
						$jobStatus = "<span class=\"red-text\">".$rows1[$i]["jobStatus"]."</span>";
					}
					else if($rows1[$i]["jobStatus"] === "PROCESSED"){
						$jobStatus = "<span class=\"green-text\">".$rows1[$i]["jobStatus"]."</span>";
					}
					
					$technicianName = "";
					//assigned technician column entry
					if($rows1[$i]["adminID"] !== NULL){
						$query2 = $this->db->query("SELECT givenName, lastName FROM adminAcc WHERE adminID=".$rows1[$i]["adminID"]);
						$rows2 = $query2->result_array();
					
						$technicianName = $tabl.$rows2[0]["givenName"]." ".$rows2[0]["lastName"];
					}
					
					//date filed column entry
					$dateFiled = date("F d, Y", strtotime($rows1[$i]["dateCreated"]));	
					
					$this->table->add_row($rows1[$i]["jobDescription"],$startDate,$finishDate,$jobStatus,$technicianName,$dateFiled,$actions);
				}
				
			}
			
			else if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){
			
				//loads Code Igniter database module
				$this->load->database();
				
				$this->table->set_heading('Description','Client','Start Date','Finish Date','Status','Technician','Date Filed','Filed By','Actions');
				
				$query1 = $this->db->query("SELECT jobID, jobDescription, startDate, finishDate, jobStatus, clientID, adminID, dateCreated, createdByType FROM job ORDER BY dateCreated DESC, jobID DESC");
				$rows1 = $query1->result_array();
				$nRows1 = count($rows1);
				
				for ($i = 0; $i < $nRows1; $i++){
					
					$query2 = $this->db->query("SELECT givenName, lastName FROM client WHERE clientID=".$rows1[$i]["clientID"]."");
					$rows2 = $query2->result_array();
					
					$clientName = $rows2[0]["givenName"]." ".$rows2[0]["lastName"];
					
					$startDate = "";	
					if($rows1[$i]["startDate"] !== NULL){
						$startDate = date("F d, Y", strtotime($rows1[$i]["startDate"]));
					}
					
					$finishDate = "";
					if($rows1[$i]["startDate"] !== NULL){
						$finishDate = date("F d, Y", strtotime($rows1[$i]["finishDate"]));
					}
					
					$jobStatus = "";
					$actions = "";
					if($rows1[$i]["jobStatus"] === "PENDING"){
						$jobStatus = "<span class=\"blue-text\">".$rows1[$i]["jobStatus"]."</span>";
						if($_SESSION["type"]==="technician") $actions = "<a class=\"btn-floating btn waves-effect waves-light green\"><i class=\"material-icons\">thumb_up</i></a>&nbsp;&nbsp;";
						$actions = $actions . "<a class=\"btn-floating btn waves-effect waves-light cyan\"><i class=\"material-icons\">mode_edit</i></a>";
						$actions = $actions . "&nbsp;&nbsp;<a class=\"btn-floating btn waves-effect waves-light red\" onclick=\"confirmCancel(".$rows1[$i]["jobID"].");\"><i class=\"material-icons\">not_interested</i></a>";
					}
					else if($rows1[$i]["jobStatus"] === "PROCESSING"){
						$jobStatus = "<span class=\"orange-text\">".$rows1[$i]["jobStatus"]."</span>";
					}
					else if($rows1[$i]["jobStatus"] === "CANCELED"){
						$jobStatus = "<span class=\"red-text\">".$rows1[$i]["jobStatus"]."</span>";
					}
					else if($rows1[$i]["jobStatus"] === "PROCESSED"){
						$jobStatus = "<span class=\"green-text\">".$rows1[$i]["jobStatus"]."</span>";
					}
					
					$technicianName = "";
					if($rows1[$i]["adminID"] !== NULL){
						$query2 = $this->db->query("SELECT givenName, lastName FROM adminAcc WHERE adminID=".$rows1[$i]["adminID"]);
						$rows2 = $query2->result_array();
					
						$technicianName = $rows2[0]["givenName"]." ".$rows2[0]["lastName"];
					}
					
					$dateFiled = date("F d, Y", strtotime($rows1[$i]["dateCreated"]));
					
					$filedBy = "";
					
					if ($rows1[$i]["createdByType"] === "client"){
						$query2 = $this->db->query("SELECT givenName, lastName FROM client WHERE clientID=".$rows1[$i]["clientID"]."");
						$rows2 = $query2->result_array();
				
						$filedBy = $rows2[0]["givenName"]." ".$rows2[0]["lastName"];
					}
					else if (($rows1[$i]["createdByType"] === "technician")||($rows1[$i]["createdByType"] === "admin")){
						$query2 = $this->db->query("SELECT givenName, lastName FROM adminAcc WHERE adminID=".$rows1[$i]["createdBy"]."");
						$rows2 = $query2->result_array();
				
						$filedBy = $rows2[0]["givenName"]." ".$rows2[0]["lastName"];
					}
					else if ($rows1[$i]["createdByType"] === "superadmin"){
						$query2 = $this->db->query("SELECT givenName, lastName FROM superAdmin WHERE superAdminID=".$rows1[$i]["createdBy"]."");
						$rows2 = $query2->result_array();
				
						$filedBy = $rows2[0]["givenName"]." ".$rows2[0]["lastName"];
					}
					
					$this->table->add_row($rows1[$i]["jobDescription"],$clientName,$startDate,$finishDate,$jobStatus,$technicianName,$dateFiled,$filedBy,$actions);
					
				}
			}
			
			$tabl = $this->table->generate();
			$this->load->view('View_jobs_view', array('table' => $tabl));
		}
		else {
			die("You are not logged-in");
		}
		
	}
}
?>