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
          if (($_SESSION['type']=== 'admin')||($_SESSION['type']=== 'technician')||($_SESSION['type']=== 'superadmin'))
          {
            $db_data = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
            $this->load->view ('Notifications_view', $db_data);
          }
          else if ($_SESSION['type']=== 'client')
          {
            $db_data = $this->nm->getClientNotifs ($_SESSION['username']);
            $this->load->view ('Notifications_view', $db_data);
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
        if(array_key_exists("notifID",$_POST))
        {
          if(array_key_exists("userID",$_POST))
          {
            if(array_key_exists("userType",$_POST))
            {
              $this->load->database ();
              $query = $this->db->query('INSERT INTO notifsRead(notifID, userID, userType, dateCreated) VALUES ('.$_POST["notifID"].','.$_POST["userID"].', \''.$_POST["userType"].'\', CURDATE())');
              if ($this->db->affected_rows() > 0)
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
          }
        }
      }
      else
      {
          redirect (base_url(), 'refresh');
      }
    }
}
?>
