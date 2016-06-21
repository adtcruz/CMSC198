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
			if($_SESSION["type"] === "client"){
				
				//loads Code Igniter database module
				$this->load->database();
				
				//table heading
				$tabl = ("<thead><tr><th data-field=\"jobDescription\">Description</th>".
						"<th data-field=\"startDate\">Start Date</th>".
						"<th data-field=\"finishDate\">Finish Date</th>".
						"<th data-field=\"jobStatus\">Status</th>".
						"<th data-field=\"technicianAssigned\">Assigned Techinician</th>".
						"<th data-field=\"dateFiled\">Date Filed</th></tr></thead><tbody>");
				
				//queries the database for the client ID of the user in session
				$query = $this->db->query("SELECT clientID FROM client WHERE username='".$_SESSION["username"]."'");
				
				//gets the results in easy-to-use array form
				$rows = $query->result_array();
				//gets the client ID
				$clientID = $rows[0]["clientID"];
				
				//queries the DB
				$query1 = $this->db->query(
					"SELECT jobDescription, startDate, finishDate, jobStatus, adminID, dateCreated FROM job WHERE clientID=".$clientID." ORDER BY jobID DESC"
				);
				
				//gets the results in easy-to-use array form
				$rows1 = $query1->result_array();
				
				$nRows1 = count($rows1);
				
				for ($i = 0; $i < $nRows1; $i++){
					
					//start of table row
					$tabl = $tabl."<tr>";
					
					//job description column entry
					$tabl = $tabl."<td>".$rows1[$i]["jobDescription"]."</td>";
					
					//start date column entry
					if($rows1[$i]["startDate"] !== NULL){
						$tabl = $tabl."<td>".date("F d, Y", strtotime($rows1[$i]["startDate"]))."</td>";
					}
					else{
						$tabl = $tabl."<td></td>";
					}
					
					//finish date column entry
					if($rows1[$i]["startDate"] !== NULL){
						$tabl = $tabl."<td>".date("F d, Y", strtotime($rows1[$i]["finishDate"]))."</td>";
					}
					else{
						$tabl = $tabl."<td></td>";
					}
					
					//job status column entry
					if($rows1[$i]["jobStatus"] === "PENDING"){
						$tabl = $tabl."<td><span class=\"blue-text\">".$rows1[$i]["jobStatus"]."</span></td>";
					}
					else if($rows1[$i]["jobStatus"] === "PROCESSING"){
						$tabl = $tabl."<td><span class=\"yellow-text\">".$rows1[$i]["jobStatus"]."</span></td>";
					}
					else if($rows1[$i]["jobStatus"] === "CANCELED"){
						$tabl = $tabl."<td><span class=\"red-text\">".$rows1[$i]["jobStatus"]."</span></td>";
					}
					else if($rows1[$i]["jobStatus"] === "PROCESSED"){
						$tabl = $tabl."<td><span class=\"green-text\">".$rows1[$i]["jobStatus"]."</span></td>";
					}
					
					//assigned technician column entry
					if($rows1[$i]["adminID"] !== NULL){
						$query2 = $this->db->query("SELECT givenName, lastName FROM adminAcc WHERE adminID=".$rows1[$i]["adminID"]);
						$rows2 = $query1->result_array();
					
						$tabl = $tabl.$rows2[0]["givenName"]." ".$rows2[0]["lastName"]."</td><td>";
					}
					else {
						$tabl = $tabl."<td></td>";
					}
					
					//date filed column entry
					$tabl = $tabl."<td>".date("F d, Y", strtotime($rows1[$i]["dateCreated"]))."</td>";
					
					//end of table row
					$tabl = $tabl."</tr>";
					
				}
				
				$tabl = $tabl . "</tbody>";
				
			}
			
			else if(($_SESSION["type"]==="technician")||($_SESSION["type"]==="admin")||($_SESSION["type"]==="superadmin")){
			
				//loads Code Igniter database module
				$this->load->database();
				
				//table heading
				$tabl = ("<thead><tr><th data-field=\"jobDescription\">Description</th>".
						"<th data-field=\"client\">Client</th>".
						"<th data-field=\"startDate\">Start Date</th>".
						"<th data-field=\"finishDate\">Finish Date</th>".
						"<th data-field=\"jobStatus\">Status</th>".
						"<th data-field=\"technicianAssigned\">Assigned Techinician</th>".
						"<th data-field=\"dateFiled\">Date Filed</th>".
						"<th data-field=\"filedBy\">Filed By</th>".
						"</tr></thead><tbody>");
				
				$query1 = $this->db->query("SELECT jobDescription, startDate, finishDate, jobStatus, clientID, adminID, dateCreated, createdByType FROM job ORDER BY dateCreated DESC, jobID DESC");
				$rows1 = $query1->result_array();
				$nRows1 = count($rows1);
				
				for ($i = 0; $i < $nRows1; $i++){
					//start of table row
					$tabl = $tabl."<tr>";
				
					//job description column entry
					$tabl = $tabl."<td>".$rows1[$i]["jobDescription"]."</td>";
				
					//client column entry
				
					$query2 = $this->db->query("SELECT givenName, lastName FROM client WHERE clientID=".$rows1[$i]["clientID"]."");
					$rows2 = $query2->result_array();
				
					$tabl = $tabl."<td>".$rows2[0]["givenName"]." ".$rows2[0]["lastName"]."</td>";
				
					//start date column entry
					if($rows1[$i]["startDate"] !== NULL){
						$tabl = $tabl."<td>".date("F d, Y", strtotime($rows1[$i]["startDate"]))."</td>";
					}
					else{
						$tabl = $tabl."<td></td>";
					}
				
					//finish date column entry
					if($rows1[$i]["startDate"] !== NULL){
						$tabl = $tabl."<td>".date("F d, Y", strtotime($rows1[$i]["finishDate"]))."</td>";
					}
					else{
						$tabl = $tabl."<td></td>";
					}
				
					//job status column entry
					if($rows1[$i]["jobStatus"] === "PENDING"){
						$tabl = $tabl."<td><span class=\"blue-text\">".$rows1[$i]["jobStatus"]."</span></td>";
					}
					else if($rows1[$i]["jobStatus"] === "PROCESSING"){
						$tabl = $tabl."<td><span class=\"yellow-text\">".$rows1[$i]["jobStatus"]."</span></td>";
					}
					else if($rows1[$i]["jobStatus"] === "CANCELED"){
						$tabl = $tabl."<td><span class=\"red-text\">".$rows1[$i]["jobStatus"]."</span></td>";
					}
					else if($rows1[$i]["jobStatus"] === "PROCESSED"){
						$tabl = $tabl."<td><span class=\"green-text\">".$rows1[$i]["jobStatus"]."</span></td>";
					}
					
					//assigned technician column entry
					if($rows1[$i]["adminID"] !== NULL){
						$query2 = $this->db->query("SELECT givenName, lastName FROM adminAcc WHERE adminID=".$rows1[$i]["adminID"]);
						$rows2 = $query1->result_array();
					
						$tabl = $tabl.$rows2[0]["givenName"]." ".$rows2[0]["lastName"]."</td><td>";
					}
					else {
						$tabl = $tabl."<td></td>";
					}
					
					//date filed column entry
					$tabl = $tabl."<td>".date("F d, Y", strtotime($rows1[$i]["dateCreated"]))."</td>";
					
					//filed by column entry
					if ($rows1[$i]["createdByType"] === "client"){
						$query2 = $this->db->query("SELECT givenName, lastName FROM client WHERE clientID=".$rows1[$i]["clientID"]."");
						$rows2 = $query2->result_array();
				
						$tabl = $tabl."<td>".$rows2[0]["givenName"]." ".$rows2[0]["lastName"]."</td>";
					}
					else if (($rows1[$i]["createdByType"] === "technician")||($rows1[$i]["createdByType"] === "admin")){
						$query2 = $this->db->query("SELECT givenName, lastName FROM adminAcc WHERE adminID=".$rows1[$i]["createdBy"]."");
						$rows2 = $query2->result_array();
				
						$tabl = $tabl."<td>".$rows2[0]["givenName"]." ".$rows2[0]["lastName"]."</td>";
					}
					else if ($rows1[$i]["createdByType"] === "superadmin"){
						$query2 = $this->db->query("SELECT givenName, lastName FROM superAdmin WHERE superAdminID=".$rows1[$i]["createdBy"]."");
						$rows2 = $query2->result_array();
				
						$tabl = $tabl."<td>".$rows2[0]["givenName"]." ".$rows2[0]["lastName"]."</td>";
					}
				}
				
			}
			
			$this->load->view('View_jobs_view', array('tableC' => $tabl));
		}
		else {
			die("You are not logged-in");
		}
		
	}
}
?>