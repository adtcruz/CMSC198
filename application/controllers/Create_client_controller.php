<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_client_controller extends CI_Controller
{
  function index(){
    session_start();
    if (array_key_exists("type",$_SESSION)){
      $err = false;
      if(!array_key_exists("username",$_POST)){
        echo "Username not defined!";
        $err = true;
      }
      if(!array_key_exists("password",$_POST)){
        echo "Password not defined!";
        $err = true;
      }
      if(!array_key_exists("givenName",$_POST)){
        echo "Given Name not defined!";
        $err = true;
      }
      if(!array_key_exists("lastName",$_POST)){
        echo "Last Name not defined!";
        $err = true;
      }
      if(!array_key_exists("designation",$_POST)){
        echo "Designation not defined!";
        $err = true;
      }
      if(!array_key_exists("officeId",$_POST)){
        echo "Office Id not defined!";
        $err = true;
      }
      if(!$err){
        $this->load->database();
        $data = array(
					'username' => $_POST["username"],
					'password' => sha1($_POST["password"]),
					'givenName' => $_POST["givenName"],
					'lastName' => $_POST["lastName"],
					'designation' => $_POST["designation"],
					'officeId' => $_POST["officeId"]
				);

        $count = $this->db->query("SELECT COUNT(clientID) FROM client WHERE username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"];
        if ($count == 1) echo "Account already exists";
        else {
          $this->db->query("INSERT INTO client(username,password,givenName,lastName,designation,officeId) VALUES ('".$_POST["username"]."',SHA1('".$_POST["password"]."'),'".$_POST["givenName"]."','".$_POST["lastName"]."','".$_POST["designation"]."',".$_POST["officeId"].")");
          $count = $this->db->query("SELECT COUNT(clientID) FROM client WHERE username='".$_POST["username"]."'")->row_array()["COUNT(clientID)"];
          if ($count == 1) echo "Created new client";
          else "Error creating client";
        }
      }
    }
  }
}
