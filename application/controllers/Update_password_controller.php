<?php
//this is the controller for the API that updates the password of the user in session
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_password_controller extends CI_Controller
{
  public function index(){

    //session start to access session variables
    session_start();

    //loads codeigniter database modulce
    $this->load->database();

    //checks if type array key exists in session
    if(array_key_exists("type",$_SESSION)){

      //if username array key exists in session
      if(array_key_exists("username",$_SESSION)){

        //if passwordold array key exists in post
        if(array_key_exists("passwordOld",$_POST)){

          //if passwordnew array key exists in post
          if(array_key_exists("passwordNew",$_POST)){

            //if the user in session is a client
            if($_SESSION["type"]==="client"){

              //checks the username and password combination
              //if it's the right one, update the password and log the action to the logs
              if($this->db->query("SELECT COUNT(clientID) FROM client WHERE username='".$_SESSION["username"]."' AND password=SHA1('".$_POST["passwordOld"]."')")->row_array()["COUNT(clientID)"]){
                $this->db->query("UPDATE client SET password=SHA1('".$_POST["passwordNew"]."') WHERE username='".$_SESSION["username"]."'");
                $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." has changed their password',CURRENT_TIMESTAMP)");
                echo "Password updated";
                return;
              }
              else{
                echo "Invalid old password";
                return;
              }
            }

            //if the user in session is an admin or technician
            if(($_SESSION["type"]==="admin")||($_SESSION["type"]==="technician")){

              //checks the username and password combination
              //if it's the right one, update the password and log the action to the logs
              if(1 == $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE username='".$_SESSION["username"]."' AND password=SHA1('".$_POST["passwordOld"]."')")->row_array()["COUNT(adminID)"]){
                $this->db->query("UPDATE adminAcc SET password=SHA1('".$_POST["passwordNew"]."') WHERE username='".$_SESSION["username"]."'");
                $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." has changed their password',CURRENT_TIMESTAMP)");
                echo "Password updated";
                return;
              }
              else{
                echo "Invalid old password";
              }
            }

            //if the user in session is a superadmin
            if($_SESSION["type"]==="superadmin"){

              //checks the username and password combination
              //if it's the right one, update the password and log the action to the logs
              if(1 == $this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE username='".$_SESSION["username"]."' AND password=SHA1('".$_POST["passwordOld"]."')")->row_array()["COUNT(superAdminID)"]){
                $this->db->query("UPDATE superAdmin SET password=SHA1('".$_POST["passwordNew"]."') WHERE username='".$_SESSION["username"]."'");
                $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." has changed their given or last name(s)',CURRENT_TIMESTAMP)");
                echo "Password updated";
              }
              else{
                echo "Invalid old password";
              }
            }
          }
        }
      }
    }

    else{

      $this->load->view('Login_view');
    }
  }
}
?>
