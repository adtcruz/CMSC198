<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_selectable_work_controller extends CI_Controller
{
	public function index ()
	{

		session_start();

		if(array_key_exists("type",$_SESSION)){

			if(($_SESSION["type"]==="superadmin")||($_SESSION["type"]==="technician")){

        if(array_key_exists("workID",$_POST)){

          if(array_key_exists("workCost",$_POST)){

            if(array_key_exists("workDescription",$_POST)){

              $this->load->database();

      				$this->db->query("UPDATE work SET workCost=".$_POST["workCost"].", workDescription='".$_POST["workDescription"]."' WHERE workID=".$_POST["workID"]."");

              $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." modified a selectable work',CURRENT_TIMESTAMP)");

							echo "Selectable work updated";

							return;
            }
          }
        }
			}
		}
	}
}
?>
