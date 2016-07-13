<?php
//this is the controller for the API that updates the job priority
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_job_priority_controller extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();

        //loads code igniter database module
        $this->load->database ();

        //session start to access session variables
        session_start();
    }

    public function index ()
    {
        // if type is defined
        if (array_key_exists ("type", $_SESSION))
        {
            // if user is type superadmin or technician
            if (($_SESSION['type'] === 'superadmin') || ($_SESSION['type'] === 'technician'))
            {
                // post needed data
                if (array_key_exists ("priority", $_POST))
                {
                    if (array_key_exists ("jobID", $_POST))
                    {
                      //updates the priority of the job in the schedule table
                      $this->db->query ('UPDATE schedule SET schedule.priority='.$_POST['priority'].' WHERE schedule.jobID='.$_POST['jobID'].'');

                      //returns a message that the priority was updated
                      echo 'Priority updated';
                      return;
                    }
                }
            }
        }
        else
        {
            $this->load->view ('Login_view');
        }
    }
}

?>
