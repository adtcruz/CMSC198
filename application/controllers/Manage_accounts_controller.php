<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_accounts_controller extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();
        $this->load->model('Manage_accounts_model','macm');
        $this->load->model ('Notifications_model', 'nm');
    }

    function index()
    {
        session_start();
        if(array_key_exists("type",$_SESSION))
        {
            $unread = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
            if($_SESSION["type"]==="superadmin")
            {
                $allUsers = $this->macm->getAllUsersTable();
                $adminUsers = $this->macm->getAdminsTable();
                $clientUsers = $this->macm->getClientsTable();
                $technicianUsers = $this->macm->getTechniciansTable();
                $superAdmins = $this->macm->getSuperadminsTable();
                $this->load->view('Manage_accounts_view', array('allUsers'=>$allUsers,'adminUsers'=>$adminUsers,'clientUsers'=>$clientUsers,'technicianUsers'=>$technicianUsers,'superAdmins'=>$superAdmins, 'unread' => $unread));
            }
            if(($_SESSION["type"]==="admin")||($_SESSION["type"]==="technician"))
            {
                $clientUsers = $this->macm->getClientsTable();
                $this->load->view('Manage_accounts_view', array('clientUsers'=>$clientUsers, 'unread' => $unread));
            }
        }
        else
        {
            $this->load->view('Login_view');
        }
    }
}
?>
