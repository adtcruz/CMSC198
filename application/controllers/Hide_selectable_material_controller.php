<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hide_selectable_material_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

        if(array_key_exists("materialID",$_POST)){

          $this->load->database();

  				$this->db->query("UPDATE materials SET active=0 WHERE materialID=".$_POST["materialID"]."");

          $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." hidden a material from the selectable choices',CURRENT_TIMESTAMP)");

					echo "Selectable material hidden";

					return;

        }
			}
		}
	}
}
?>
