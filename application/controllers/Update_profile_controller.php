<?php
//this is the controller for the API that updates the user profile
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_profile_controller extends CI_Controller
{
  public function index(){

    //session start to access session variables
    session_start();

    //loads code igniter database module
    $this->load->database();

    //if type is defined
    if(array_key_exists("type",$_SESSION)){

      //if username is defined
      if(array_key_exists("username",$_SESSION)){

        //if givenName is defined
        if(array_key_exists("givenName",$_POST)){

          //if lastName is defined
          if(array_key_exists("lastName",$_POST)){

            //if user in session is a client
            //update the given and last names in the database
            //update the session variables holding the given and last names
            //record the action to logs
            //sends a message that the profile was updated
            if($_SESSION["type"]==="client"){
              $this->db->query("UPDATE client SET givenName='".$_POST["givenName"]."',lastName='".$_POST["lastName"]."' WHERE username='".$_SESSION["username"]."'");
              $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." has changed their given or last name(s)',CURRENT_TIMESTAMP)");
              $_SESSION["givenName"] = $_POST["givenName"];
              $_SESSION["lastName"] = $_POST["lastName"];
              echo "Profile updated";
            }

            //if user in session is an admin or technician
            //update the given and last names in the database
            //update the session variables holding the given and last names
            //record the action to logs
            //sends a message that the profile was updated
            if(($_SESSION["type"]==="admin")||($_SESSION["type"]==="technician")){
              $this->db->query("UPDATE adminAcc SET givenName='".$_POST["givenName"]."',lastName='".$_POST["lastName"]."' WHERE username='".$_SESSION["username"]."'");
              $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." has changed their given or last name(s)',CURRENT_TIMESTAMP)");
              $_SESSION["givenName"] = $_POST["givenName"];
              $_SESSION["lastName"] = $_POST["lastName"];
              echo "Profile updated";
            }

            //if user in session is a superadmin
            //update the given and last names in the database
            //update the session variables holding the given and last names
            //record the action to logs
            //sends a message that the profile was updated
            if($_SESSION["type"]==="superadmin"){
              $this->db->query("UPDATE superAdmin SET givenName='".$_POST["givenName"]."',lastName='".$_POST["lastName"]."' WHERE username='".$_SESSION["username"]."'");
              $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." has changed their given or last name(s)',CURRENT_TIMESTAMP)");
              $_SESSION["givenName"] = $_POST["givenName"];
              $_SESSION["lastName"] = $_POST["lastName"];
              echo "Profile updated";
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
