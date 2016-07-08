<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_selectable_services_controller extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();
        session_start ();
    }
}
?>
