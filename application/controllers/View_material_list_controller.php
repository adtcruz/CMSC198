<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_material_list_controller extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();
        session_start();
        if(array_key_exists("type",$_SESSION)){
            $this->load->model ('View_material_list_model', 'vmlm');
        }
        else{
            $this->load->view('Login_view');
        }
    }

    public function index ()
    {
        $this->vmlm->getMaterials ();
        $this->load->view ('View_material_list_view');
    }
}
?>
