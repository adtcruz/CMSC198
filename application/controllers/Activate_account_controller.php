<?php
/*
*   file: Activate_account_controller.php
*       This file is AJAX controller for the 'Activate Account' function
*       in the 'Manage Account' module.
*/

// deny direct access
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class declaration
class Activate_account_controller extends CI_Controller
{
	public function index ()
	{
        // start session
        session_start();

        // if type is initialized, proceed
		if(array_key_exists("type",$_SESSION))
		{
            // if username is initialized, proceed
            if(array_key_exists("username",$_POST))
			{
                // one cannot activate oneself's account
                if($_POST["username"]===$_SESSION["username"])
				{
					return;
				}
                // else, activate said account. use 'username' as account tracker
				else
				{
					$this->load->database();
                    // for super admin accounts
					if($this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE BINARY username='".$_POST["username"]."'")->row_array()["COUNT(superAdminID)"]==1)
					{
						$this->db->query("UPDATE superAdmin SET active=1 WHERE BINARY username='".$_POST["username"]."'");
						$this->db->query("INSERT INTO userLogs(logText, logTimestamp) VALUES ('".$_SESSION["username"]." activated ".$_POST["username"]."\'s account ',CURRENT_TIMESTAMP)");
						echo "Activated account";
						return;
					}
					else
					{
                        // for admin accounts
                        if($this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE BINARY username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"]==1)
						{
							$this->db->query("UPDATE adminAcc SET active=1 WHERE BINARY username='".$_POST["username"]."'");
							$this->db->query("INSERT INTO userLogs(logText, logTimestamp) VALUES ('".$_SESSION["username"]." activated ".$_POST["username"]."\'s account ',CURRENT_TIMESTAMP)");
							echo "Activated account";
							return;
						}
                        // for client accounts
						else
						{
							if($this->db->query("SELECT COUNT(clientID) FROM client WHERE BINARY username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"]==1)
							{
								$this->db->query("UPDATE client SET active=1 WHERE BINARY username='".$_POST["username"]."'");
								$this->db->query("INSERT INTO userLogs(logText, logTimestamp) VALUES ('".$_SESSION["username"]." disabled ".$_POST["username"]."\'s account ',CURRENT_TIMESTAMP)");
								echo "Activated account";
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
