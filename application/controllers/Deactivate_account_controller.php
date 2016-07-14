<?php
//this is the controller for the API that disables accounts
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deactivate_account_controller extends CI_Controller
{
	public function index ()
	{
		//session start to access session variables
		session_start();

    //checks if the type array key exists in session
    //if it exists it means there is a user currently in session
		if(array_key_exists("type",$_SESSION))
		{

			//checks if username is defined in POST
			if(array_key_exists("username",$_POST))
			{
				//checks if the username in post is the same as the username of the user in session
				//if it is preterminate the execution of the script
				if($_POST["username"]===$_SESSION["username"])
				{
					return;
				}

				else
				{

					//loads the codeigniter database module
					$this->load->database();

					//checks if the username is in the superadmin table
					if($this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE BINARY username='".$_POST["username"]."'")->row_array()["COUNT(superAdminID)"]==1)
					{

						//if it does, set the active entry of the row to nought
						//this means the account is deactivated
						$this->db->query("UPDATE superAdmin SET active=0 WHERE BINARY username='".$_POST["username"]."'");

						//record this activity to the userlogs
						$this->db->query("INSERT INTO userLogs(logText, logTimestamp) VALUES ('".$_SESSION["username"]." deactivated ".$_POST["username"]."\'s account ',CURRENT_TIMESTAMP)");

						//sends a message that the account was deactivated
						echo "Deactivated account";

						//preterminates the execution of the script
						return;
					}
					else
					{
						//checks if the username exists in the adminAcc table
						if($this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE BINARY username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"]==1)
						{

							//if it does, set the active entry of the row to nought
							//this means the account is deactivated
							$this->db->query("UPDATE adminAcc SET active=0 WHERE BINARY username='".$_POST["username"]."'");

							//record this activity to the userlogs
							$this->db->query("INSERT INTO userLogs(logText, logTimestamp) VALUES ('".$_SESSION["username"]." deactivated ".$_POST["username"]."\'s account ',CURRENT_TIMESTAMP)");

							//sends a message that the account was deactivated
							echo "Deactivated account";

							//preterminates the execution of the script
							return;
						}
						else
						{
							//checks if the username exists in the client table
							if($this->db->query("SELECT COUNT(clientID) FROM client WHERE BINARY username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"]==1)
							{

								//if it does, set the active entry of the row to nought
								//this means the account is deactivated
								$this->db->query("UPDATE client SET active=0 WHERE BINARY username='".$_POST["username"]."'");

								//record this activity to the userlogs
								$this->db->query("INSERT INTO userLogs(logText, logTimestamp) VALUES ('".$_SESSION["username"]." deactivated ".$_POST["username"]."\'s account ',CURRENT_TIMESTAMP)");

								//sends a message that the account was deactivated
								echo "Deactivated account";

								//preterminates the execution of the script
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
