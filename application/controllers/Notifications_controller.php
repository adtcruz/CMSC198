<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications_controller extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();
        $this->load->model ('Notifications_model', 'nm');
        session_start ();
    }

    public function index ()
    {
        if (array_key_exists ('type', $_SESSION))
        {
            if ($_SESSION['type'] != 'client')
            {
                $db_data = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
                $this->load->view ('Notifications_view', $db_data);
            }
            else
            {
    			redirect (base_url(), 'refresh');
    		}
        }
        else
        {
            redirect (base_url(), 'refresh');
        }
    }

    public function markAsRead ()
    {
        if (array_key_exists ('type', $_SESSION))
        {
            if ($_SESSION['type'] != 'client')
            {
                // use uri segments 3 (notifID), 4 (userID), 5 (userType)
                $this->load->database ();
                $query = $this->db->query ('INSERT INTO notifsRead (notifID, userID, userType, dateCreated) VALUES ('.$this->uri->segment (3).', '.$this->uri->segment (4).', \''.$this->uri->segment (5).'\', CURDATE())');
                if ($this->db->affected_rows () > 0)
                {
                    echo "Marked as read";
                    return;
                }
                else
                {
                    echo "Error";
                    return;
                }
            }
            else
            {
                redirect (base_url(), 'refresh');
            }
        }
        else
        {
            redirect (base_url(), 'refresh');
        }
    }
}
?>
