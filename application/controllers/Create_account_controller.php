<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_account_controller extends CI_Controller
{
  function index(){
    session_start();
    $this->load->database();
    if (array_key_exists("type",$_SESSION)){

      if(($_SESSION["type"]==="admin")||($_SESSION["type"]==="technician")||($_SESSION["type"]==="superadmin")){

        if(array_key_exists("accountType",$_POST)){

          if($_POST["accountType"]==="client"){
            $count = $this->db->query("SELECT COUNT(clientID) FROM client WHERE username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE username='".$_POST["username"]."'")->row_array()["COUNT(superAdminID)"];
            if ($count == 1) die("Account already exists");
            else {
              $this->db->query("INSERT INTO client(username,password,givenName,lastName,designation,officeId) VALUES ('".$_POST["username"]."',SHA1('".$_POST["password"]."'),'".$_POST["givenName"]."','".$_POST["lastName"]."','".$_POST["designation"]."',".$_POST["officeId"].")");
              $count = $this->db->query("SELECT COUNT(clientID) FROM client WHERE username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"];
              if ($count == 1) echo "Created new client";
              else echo "Error creating client";
            }
          }

          if($_POST["accountType"]==="admin"){
            $count = $this->db->query("SELECT COUNT(clientID) FROM client WHERE username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE username='".$_POST["username"]."'")->row_array()["COUNT(superAdminID)"];
            if ($count == 1) die("Account already exists");
            else {
              $this->db->query("INSERT INTO adminAcc(username,password,givenName,lastName,isTechnician) VALUES ('".$_POST["username"]."',SHA1('".$_POST["password"]."'),'".$_POST["givenName"]."','".$_POST["lastName"]."',0)");
              $count = $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"];
              if ($count == 1) echo "Created new admin";
              else echo "Error creating admin";
            }
          }

          if($_POST["accountType"]==="technician"){
            $count = $this->db->query("SELECT COUNT(clientID) FROM client WHERE username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE username='".$_POST["username"]."'")->row_array()["COUNT(superAdminID)"];
            if ($count == 1) die("Account already exists");
            else {
              $this->db->query("INSERT INTO adminAcc(username,password,givenName,lastName,isTechnician) VALUES ('".$_POST["username"]."',SHA1('".$_POST["password"]."'),'".$_POST["givenName"]."','".$_POST["lastName"]."',1)");
              $count = $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"];
              if ($count == 1) echo "Created new technician";
              else echo "Error creating technician";
            }
          }

          if($_POST["accountType"]==="superadmin"){
            $count = $this->db->query("SELECT COUNT(clientID) FROM client WHERE username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE username='".$_POST["username"]."'")->row_array()["COUNT(superAdminID)"];
            if ($count == 1) die("Account already exists");
            else {
              $this->db->query("INSERT INTO superAdmin(username,password,givenName,lastName) VALUES ('".$_POST["username"]."',SHA1('".$_POST["password"]."'),'".$_POST["givenName"]."','".$_POST["lastName"]."')");
              $count = $this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE username='".$_POST["username"]."'")->row_array()["COUNT(superAdminID)"];
              if ($count == 1) echo "Created new superadmin";
              else echo "Error creating superadmin";
            }
          }
        }
      }

      else{

      }
    }
  }
}
