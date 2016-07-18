<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Notifications_model extends CI_Model
    {
        public function __construct ()
        {
            parent::__construct ();
            $this->load->database ();
        }

        public function notifBillGenerated ($username, $jobID)
        {
            // get client id using username
            $query = $this->db->query ('SELECT client.clientID FROM client WHERE (client.username = "'.$username.'")');
            $clientID = $query->result_array ()[0]['clientID'];

            // check if bill has been already generated
            $query = $this->db->query ('SELECT notifications.clientID, notifications.jobID FROM notifications WHERE (notifications.clientID = '.$clientID.') AND (notifications.jobID = '.$jobID.')');

            // get officeAbbr of client;
            $query = $this->db->query ('SELECT office.officeAbbr FROM office WHERE (client.clientID = '.$clientID.') AND (client.officeID = office.officeID)');
            $officeAbbr = $query->result_array ()[0]['officeAbbr'];

            // if there is an entry that already exists, ignore. else, insert notification
            if ($this->db->affected_rows () > 0)
            {
                return;
            }
            else
            {
                $query = $this->db->query ('INSERT INTO notifications(notifText, dateCreated, createdBy, createdByType) VALUES ("Client - '.$username.' of '.$officeAbbr.' generated bill for Job ID - '.$jobID.'", CURDATE(), '.$clientID.', "client")');
            }
        }

        public function getUnreadCount ($username, $type)
        {
            $userID = '';
            // get userID based on usertype and username
            switch ($type)
            {
                case 'admin':
                case 'technician':
                    $query = $this->db->query ('SELECT adminAcc.adminID FROM adminAcc WHERE (adminAcc.username = "'.$username.'")');
                    $userID = $query->result_array ()[0]['adminID'];
                break;

                case 'superadmin':
                    $query = $this->db->query ('SELECT superAdmin.superAdminID FROM superAdmin WHERE (superAdmin.username = "'.$username.'")');
                    $userID = $query->result_array ()[0]['superAdminID'];
                break;
            }
            // get total notif counts
            $query = $this->db->query ('SELECT COUNT(notifications.notifID) AS count FROM notifications');
            $count = $query->result_array ()[0]['count'];

            if($count == 0){
              $db_data['unread'] = 0;
              $db_data['unreadNotifs'] = "<h5 class='center-align'>Sorry, there are no notifications to display.</h5>";
              return $db_data;
            }

            $unread = 0;
            $temp = 0;
            // for each notifID, check if pairing (notifID, userID, userType) exists. if the pairing does not exist, add 1 to unread;
            do
            {
              $temp++;
              $query = $this->db->query ('SELECT notifsRead.userID FROM notifsRead WHERE (notifsRead.notifID = '.$temp.') AND (notifsRead.userID = '.$userID.') AND (notifsRead.userType = "'.$type.'")');
              if ($this->db->affected_rows () == 0)
              {
                  $query = $this->db->query('SELECT notifications.notifText FROM notifications WHERE (notifications.notifID = '.$temp.')');
                  $this->table->add_row($query->result_array()[0]['notifText'], '<a class = "btn blue-grey" href = "'.base_url().'notifications/mark_as_read/'.$temp.'/'.$userID.'/'.$type.'">Mark as Read</a>');
                  $unread++;
              }
            } while ($temp != $count);

            $db_data['unread'] = $unread;
            $db_data['unreadNotifs'] = $this->table->generate();
            return $db_data;
        }
    }
?>
