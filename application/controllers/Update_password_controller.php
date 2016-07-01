<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_password_controller extends CI_Controller
{
  public function index(){

    session_start();

    $this->load->database();

    if(array_key_exists("type",$_SESSION)){

      if(array_key_exists("username",$_SESSION)){

        if(array_key_exists("passwordOld",$_POST)){

          if(array_key_exists("passwordNew",$_POST)){

            if($_SESSION["type"]==="client"){

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

            if(($_SESSION["type"]==="admin")||($_SESSION["type"]==="technician")){

              if(1 == $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE username='".$_SESSION["username"]."' AND password=SHA1('".$_POST["passwordOld"]."')")->row_array()["COUNT(adminID)"]){

                $this->db->query("UPDATE adminAcc SET password=SHA1('".$_POST["passwordNew"]."') WHERE username='".$_SESSION["username"]."'");

                $this->db->query("INSERT INTO userLogs(logText,logTimestamp) VALUES ('".$_SESSION["username"]." has changed their password',CURRENT_TIMESTAMP)");

                echo "Password updated";
              }

              else{

                echo "Invalid old password";
              }
            }

            if($_SESSION["type"]==="superadmin"){

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
