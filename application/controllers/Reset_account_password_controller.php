<?php
//this is the controller for the API that resets the password of an account
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_account_password_controller extends CI_Controller
{
	public function index ()
	{
		//session start to access session variables
		session_start();

		//checks if the type array key exists in session
		if(array_key_exists("type",$_SESSION))
		{

			//checks if username array key exists in post
			if(array_key_exists("username",$_POST))
			{

				//checks if password array key exists in post
				if(array_key_exists("password",$_POST))
				{
					//if the username specified in post is the same as the username of the user in session
					//do no proceed
					if($_POST["username"]===$_SESSION["username"])
					{
						return;
					}

					else
					{
						//loads the code igniter database module
						$this->load->database();

						//checks if the username is found in the superadmin table
						//if it is found change the password and record the action to the logs
						//and return a message that the account password was reset
						if($this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE BINARY username='".$_POST["username"]."'")->row_array()["COUNT(superAdminID)"]==1)
						{
							$this->db->query("UPDATE superAdmin SET password=SHA1('".$_POST["password"]."') WHERE BINARY username='".$_POST["username"]."'");
							$this->db->query("INSERT INTO userLogs(logText, logTimestamp) VALUES ('".$_SESSION["username"]." reset ".$_POST["username"]."\'s password',CURRENT_TIMESTAMP)");
							echo "Account password reset";
							return;
						}
						else
						{
							//checks if the username is found in the admin table
							//if it is found change the password and record the action to the logs
							//and return a message that the account password was reset
							if($this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE BINARY username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"]==1)
							{
								$this->db->query("UPDATE adminAcc SET password=SHA1('".$_POST["password"]."') WHERE BINARY username='".$_POST["username"]."'");
								$this->db->query("INSERT INTO userLogs(logText, logTimestamp) VALUES ('".$_SESSION["username"]." reset ".$_POST["username"]."\'s password',CURRENT_TIMESTAMP)");
								echo "Account password reset";
								return;
							}
							else
							{
								//checks if the username is found in the client table
								//if it is found change the password and record the action to the logs
								//and return a message that the account password was reset
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
}
?>
