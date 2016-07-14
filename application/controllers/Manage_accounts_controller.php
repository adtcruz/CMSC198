<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_accounts_controller extends CI_Controller
{
  function index(){

    session_start();

    if(array_key_exists("type",$_SESSION)){
      $this->load->model('Manage_accounts_model','macm');
      if($_SESSION["type"]==="superadmin"){
        $allUsers = $this->macm->getAllUsersTable();
        $adminUsers = $this->macm->getAdminsTable();
        $clientUsers = $this->macm->getClientsTable();
        $technicianUsers = $this->macm->getTechniciansTable();
        $superAdmins = $this->macm->getSuperadminsTable();
        $this->load->view('Manage_accounts_view', array('allUsers'=>$allUsers,'adminUsers'=>$adminUsers,'clientUsers'=>$clientUsers,'technicianUsers'=>$technicianUsers,'superAdmins'=>$superAdmins));
      }
      if(($_SESSION["type"]==="admin")||($_SESSION["type"]==="technician")){
        $clientUsers = $this->macm->getClientsTable();
        $this->load->view('Manage_accounts_view', array('clientUsers'=>$clientUsers));
      }
    }
    else{
      $this->load->view('Login_view');
    }
  }
}
