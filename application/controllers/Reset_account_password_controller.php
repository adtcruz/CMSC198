<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_account_password_controller extends CI_Controller
{
	public function index ()
	{
		session_start();
		if(array_key_exists("type",$_SESSION))
		{
			if(array_key_exists("username",$_POST))
			{
				if($_POST["username"]===$_SESSION["username"])
				{
					return;
				}
				else
				{
					$this->load->database();
					if($this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE BINARY username='".$_POST["username"]."'")->row_array()["COUNT(superAdminID)"]==1)
					{
						$this->db->query("UPDATE superAdmin SET password=SHA1('".$_POST["password"]."') WHERE BINARY username='".$_POST["username"]."'");
						$this->db->query("INSERT INTO userLogs(logText, logTimestamp) VALUES ('".$_SESSION["username"]." reset ".$_POST["username"]."\'s password',CURRENT_TIMESTAMP)");
						echo "Account password reset";
						return;
					}
					else
					{
						if($this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE BINARY username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"]==1)
						{
							$this->db->query("UPDATE adminAcc SET password=SHA1('".$_POST["password"]."') WHERE BINARY username='".$_POST["username"]."'");
							$this->db->query("INSERT INTO userLogs(logText, logTimestamp) VALUES ('".$_SESSION["username"]." reset ".$_POST["username"]."\'s password',CURRENT_TIMESTAMP)");
							echo "Account password reset";
							return;
						}
						else
						{
							if($this->db->query("SELECT COUNT(clientID) FROM client WHERE BINARY username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"]==1)
							{
								$this->db->query("UPDATE client SET password=SHA1('".$_POST["password"]."') WHERE BINARY username='".$_POST["username"]."'");
								$this->db->query("INSERT INTO userLogs(logText, logTimestamp) VALUES ('".$_SESSION["username"]." reset ".$_POST["username"]."\'s password',CURRENT_TIMESTAMP)");
								echo "Account password reset";
								return;
							}
						}
					}
				}
			}
		}
  }
}
?>
