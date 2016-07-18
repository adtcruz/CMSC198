<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_selectable_materials_controller extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();
        session_start();
        if(array_key_exists("type",$_SESSION)){
            $this->load->model ('Manage_selectable_materials_model', 'msmm');
            $this->load->model ('Notifications_model', 'nm');
        }
        else{
            $this->load->view('Login_view');
            return;
        }
    }

    public function index ()
    {
      if(($_SESSION["type"]=="admin")||($_SESSION["type"]=="technician")||($_SESSION["type"]=="superadmin"))
      {
        $materialsTable = $this->msmm->getTable();
        $unread = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
        $this->load->view('Manage_selectable_materials_view',array('materialsTable'=>$materialsTable, 'unread' => $unread));
      }
    }
}
?>
