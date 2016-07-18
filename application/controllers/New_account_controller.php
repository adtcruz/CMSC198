<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class New_account_controller extends CI_Controller
{
    function index()
    {
        $this->load->model('Job_requests_model','jrm');
        session_start();
        $options = "";
        if(array_key_exists("type",$_SESSION))
        {
            if($_SESSION['type'] != 'client')
            {
                $options = $this->jrm->getOffices($_SESSION['type']);
                $this->load->view('New_account_view', array('options' => $options));
            }
        }
        else
        {
            $this->load->view('Login_view');
        }
    }
}
?>
