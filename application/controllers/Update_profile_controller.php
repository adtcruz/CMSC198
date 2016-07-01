<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_profile_controller extends CI_Controller
{
  public function index(){

    session_start();

    $this->load->database();

    if(array_key_exists("type",$_SESSION)){

      if(array_key_exists("username",$_SESSION)){

        if(array_key_exists("givenName",$_POST)){

          if(array_key_exists("lastName",$_POST)){

            if($_SESSION["type"]==="client"){

              $this->db->query("UPDATE client SET givenName='".$_POST["givenName"]."',lastName='".$_POST["lastName"]."' WHERE username='".$_SESSION["username"]."'");

              $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." has changed their given or last name(s)',CURRENT_TIMESTAMP)");

              $_SESSION["givenName"] = $_POST["givenName"];

              $_SESSION["lastName"] = $_POST["lastName"];

              echo "Profile updated";
            }

            if(($_SESSION["type"]==="admin")||($_SESSION["type"]==="technician")){

              $this->db->query("UPDATE adminAcc SET givenName='".$_POST["givenName"]."',lastName='".$_POST["lastName"]."' WHERE username='".$_SESSION["username"]."'");

              $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." has changed their given or last name(s)',CURRENT_TIMESTAMP)");

              $_SESSION["givenName"] = $_POST["givenName"];

              $_SESSION["lastName"] = $_POST["lastName"];

              echo "Profile updated";
            }

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
