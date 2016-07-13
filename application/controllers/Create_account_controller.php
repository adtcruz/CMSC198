<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//controller for the API that creates new accounts
class Create_account_controller extends CI_Controller
{
  function index(){

    //session start to access session variables
    session_start();

    //loads codeigniter database module
    $this->load->database();

    //checks if the type array key exists in session
    //if it exists it means there is a user currently in session
    if (array_key_exists("type",$_SESSION)){

      //checks if the user in session is an admin, technician, or superadmin
      if(($_SESSION["type"]==="admin")||($_SESSION["type"]==="technician")||($_SESSION["type"]==="superadmin")){

        //cehcks if accountType exists in POST
        if(array_key_exists("accountType",$_POST)){

          //checks if accountType in post is client
          //means that the account to be created is a client account
          if($_POST["accountType"]==="client"){

            //checks if the username defined in post exists in the client, adminAcc, and superAdmin tables
            //if it such a username already exists, the execution of this script is preterminated
            $count = $this->db->query("SELECT COUNT(clientID) FROM client WHERE username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE username='".$_POST["username"]."'")->row_array()["COUNT(superAdminID)"];
            if ($count == 1) die("Account already exists");
            else {

              //if it does not exist, create a new client account
              $this->db->query("INSERT INTO client(username,password,givenName,lastName,designation,officeId) VALUES ('".$_POST["username"]."',SHA1('".$_POST["password"]."'),'".$_POST["givenName"]."','".$_POST["lastName"]."','".$_POST["designation"]."',".$_POST["officeId"].")");

              //checks if a new client account was created by checking for the number of clientID with the given username
              $count = $this->db->query("SELECT COUNT(clientID) FROM client WHERE username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"];

              //since username should be unique, there should only be a single row
              //if there is a single row, it means that the client account was created
              if ($count == 1) echo "Created new client";
              else echo "Error creating client";
            }
          }

          //checks if accountType in post is admin
          //means that the account to be created is an admin account
          if($_POST["accountType"]==="admin"){

            //checks if the username defined in post exists in the client, adminAcc, and superAdmin tables
            //if it such a username already exists, the execution of this script is preterminated
            $count = $this->db->query("SELECT COUNT(clientID) FROM client WHERE username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE username='".$_POST["username"]."'")->row_array()["COUNT(superAdminID)"];
            if ($count == 1) die("Account already exists");
            else {

              //if it does not exist, create a new admin account
              $this->db->query("INSERT INTO adminAcc(username,password,givenName,lastName,isTechnician) VALUES ('".$_POST["username"]."',SHA1('".$_POST["password"]."'),'".$_POST["givenName"]."','".$_POST["lastName"]."',0)");

              //checks if a new client account was created by checking for the number of adminID with the given username
              $count = $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"];

              //since username should be unique, there should only be a single row
              //if there is a single row, it means that the admin account was created
              if ($count == 1) echo "Created new admin";
              else echo "Error creating admin";
            }
          }

          //checks if accountType in post is technician
          //means that the account to be created is an technician account
          if($_POST["accountType"]==="technician"){

            //checks if the username defined in post exists in the client, adminAcc, and superAdmin tables
            //if it such a username already exists, the execution of this script is preterminated
            $count = $this->db->query("SELECT COUNT(clientID) FROM client WHERE username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE username='".$_POST["username"]."'")->row_array()["COUNT(superAdminID)"];
            if ($count == 1) die("Account already exists");
            else {

              //if it does not exist, create a new technician account
              $this->db->query("INSERT INTO adminAcc(username,password,givenName,lastName,isTechnician) VALUES ('".$_POST["username"]."',SHA1('".$_POST["password"]."'),'".$_POST["givenName"]."','".$_POST["lastName"]."',1)");

              //checks if a new client account was created by checking for the number of adminID with the given username
              $count = $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"];

              //since username should be unique, there should only be a single row
              //if there is a single row, it means that the admin account was created
              if ($count == 1) echo "Created new technician";
              else echo "Error creating technician";
            }
          }

          //checks if accountType in post is superadmin
          //means that the account to be created is a superadmin account
          if($_POST["accountType"]==="superadmin"){

            //checks if the username defined in post exists in the client, adminAcc, and superAdmin tables
            //if it such a username already exists, the execution of this script is preterminated
            $count = $this->db->query("SELECT COUNT(clientID) FROM client WHERE username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(adminID) FROM adminAcc WHERE username='".$_POST["username"]."'")->row_array()["COUNT(adminID)"];
            if ($count == 1) die("Account already exists");
            $count = $this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE username='".$_POST["username"]."'")->row_array()["COUNT(superAdminID)"];
            if ($count == 1) die("Account already exists");
            else {

              //if it does not exist, create a new superadmin account
              $this->db->query("INSERT INTO superAdmin(username,password,givenName,lastName) VALUES ('".$_POST["username"]."',SHA1('".$_POST["password"]."'),'".$_POST["givenName"]."','".$_POST["lastName"]."')");

              //checks if a new client account was created by checking for the number of adminID with the given username
              $count = $this->db->query("SELECT COUNT(superAdminID) FROM superAdmin WHERE username='".$_POST["username"]."'")->row_array()["COUNT(superAdminID)"];

              //since username should be unique, there should only be a single row
              //if there is a single row, it means that the admin account was created
              if ($count == 1) echo "Created new superadmin";
              else echo "Error creating superadmin";
            }
          }
        }
      }
    }
  }
}
