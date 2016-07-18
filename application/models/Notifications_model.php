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
            // get officeAbbr of client;
            $query = $this->db->query ('SELECT office.officeAbbr FROM office, client WHERE (client.clientID = '.$clientID.') AND (client.officeID = office.officeID)');
            $officeAbbr = $query->result_array ()[0]['officeAbbr'];
            // check if bill has been already generated
            $query = $this->db->query ('SELECT notifications.clientID, notifications.jobID FROM notifications WHERE (notifications.clientID = '.$clientID.') AND (notifications.jobID = '.$jobID.')');
            // if there is an entry that already exists, ignore. else, insert notification
            if ($this->db->affected_rows () > 0)
            {
                return;
            }
            else
            {
                $query = $this->db->query ('INSERT INTO notifications(notifText, dateCreated, createdBy, createdByType, clientID,jobID) VALUES ("Client - '.$username.' of '.$officeAbbr.' generated bill for Job ID - '.$jobID.'", CURDATE(), '.$clientID.', "client",'.$clientID.','.$jobID.')');
            }
        }

        public function getClientNotifs ($username)
        {
            $query = $this->db->query ('SELECT clientID FROM client WHERE (username = "'.$username.'")');
            $userID = $query->result_array ()[0]['clientID'];
            $unread = 0;
            $this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));
            $this->table->set_heading("Notification Details","");
            $rows = $this->db->query ('SELECT notifID FROM notifications WHERE (createdByType != \'client\')')->result_array();
            if($this->db->affected_rows() == 0){
              $db_data['unread'] = 0;
              $db_data['unreadNotifs'] = "<h5 class='center-align'>Sorry, there are no notifications to display.</h5>";
              return $db_data;
            }
            foreach ($rows as $row)
            {
                $this->db->query ('SELECT notifsRead.notifID, notifsRead.userID FROM notifsRead WHERE (notifsRead.userType = \'client\') AND (notifsRead.notifID = '.$row['notifID'].') AND (notifsRead.userID = "'.$userID.'")');
                if ($this->db->affected_rows () == 0)
                {
                  $query2 = $this->db->query('SELECT notifText FROM notifications WHERE (notifID = '.$row['notifID'].')');
                  $this->table->add_row($query2->result_array()[0]['notifText'], '<a class = "waves-light waves-effect btn blue darken-4" onclick="markAsRead(\''.base_url().'\','.$row['notifID'].','.$userID.',\'client\')">Mark as Read</a>');
                  $unread++;
                }
            }
            if($unread == 0){
              $db_data['unread'] = 0;
              $db_data['unreadNotifs'] = "<h5 class='center-align'>Sorry, there are no notifications to display.</h5>";
              return $db_data;
            }
            $db_data['unread'] = $unread;
            $db_data['unreadNotifs'] = $this->table->generate();
            return $db_data;
        }

        public function getReadNotifs ($username, $type)
        {
            // get user ID
            $userID = "";
            switch ($type)
            {
                case 'client':
                    $query = $this->db->query ('SELECT client.clientID FROM client WHERE (client.username = "'.$username.'")');
                    $userID = $query->result_array ()[0]['clientID'];
                break;
                case 'admin':
                case 'technician':
                    $query = $this->db->query ('SELECT adminAcc.adminID FROM adminAcc WHERE (adminAcc.username = "'.$username.'")');
                    $userID = $query->result_array ()[0]['adminID'];
                break;
                case 'superadmin':
                    $query = $this->db->query ('SELECT superAdmin.superAdminID FROM adminAcc WHERE (superAdmin.username = "'.$username.'")');
                    $userID = $query->result_array ()[0]['superAdminID'];
                break;
                default:
                    redirect (base_url (), 'refresh');
            }

            // set table template
            $this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));
            $this->table->set_heading("Notification Details");

            // get all notifs read where usertype is $type
            $query = $this->db->query ('SELECT notifsRead.notifID, notifsRead.userID FROM notifsRead WHERE (notifsRead.userType = "'.$type.'")');
            $notifs = $query->result_array ();

            // foreach notifs, select those where userID = $userID and notifReadID = notifID (to get proper notifs)

            foreach ($notifs as $row)
            {
                $query = $this->db->query ('SELECT notifsRead.userID, notifications.notifText FROM notifsRead, notifications WHERE (notifsRead.userID = '.$userID.') AND (notifsRead.notifID = notifications.notifID)');
                if ($this->db->affected_rows () > 0)
                {
                    $this->table->add_row ($query->result_array ()[0]['notifText']);
                }
            }

            $table = $this->table->generate ();
            return $table;
        }

        public function getReadNotifs ($username, $type)
        {
            // get user ID
            $userID = "";
            switch ($type)
            {
                case 'client':
                    $query = $this->db->query ('SELECT client.clientID FROM client WHERE (client.username = "'.$username.'")');
                    $userID = $query->result_array ()[0]['clientID'];
                break;
                case 'admin':
                case 'technician':
                    $query = $this->db->query ('SELECT adminAcc.adminID FROM adminAcc WHERE (adminAcc.username = "'.$username.'")');
                    $userID = $query->result_array ()[0]['adminID'];
                break;
                case 'superadmin':
                    $query = $this->db->query ('SELECT superAdmin.superAdminID FROM adminAcc WHERE (superAdmin.username = "'.$username.'")');
                    $userID = $query->result_array ()[0]['superAdminID'];
                break;
                default:
                    redirect (base_url (), 'refresh');
            }

            // set table template
            $this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));
            $this->table->set_heading("Notification Details");

            // get all notifs read where usertype is $type
            $query = $this->db->query ('SELECT notifsRead.notifID, notifsRead.userID FROM notifsRead WHERE (notifsRead.userType = "'.$type.'")');
            $notifs = $query->result_array ();

            // foreach notifs, select those where userID = $userID and notifReadID = notifID (to get proper notifs)

            foreach ($notifs as $row)
            {
                $query = $this->db->query ('SELECT notifsRead.userID, notifications.notifText FROM notifsRead, notifications WHERE (notifsRead.userID = '.$userID.') AND (notifsRead.notifID = notifications.notifID)');
                if ($this->db->affected_rows () > 0)
                {
                    $this->table->add_row ($query->result_array ()[0]['notifText']);
                }
            }

            $table = $this->table->generate ();
            return $table;
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
            $unread = 0;
            $this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));
            $this->table->set_heading("Notification Details","");
            $rows = $this->db->query('SELECT notifID FROM notifications WHERE (createdByType = \'client\')')->result_array();
            if($this->db->affected_rows() == 0){
              $db_data['unread'] = 0;
              $db_data['unreadNotifs'] = "<h5 class='center-align'>Sorry, there are no notifications to display.</h5>";
              return $db_data;
            }
            foreach($rows as $row){
              $this->db->query('SELECT notifsRead.userID FROM notifsRead WHERE (notifsRead.notifID = '.$row['notifID'].') AND (notifsRead.userID = '.$userID.') AND (notifsRead.userType = "'.$type.'")');
              if($this->db->affected_rows() == 0){
                $query2 = $this->db->query('SELECT notifications.notifText FROM notifications WHERE (notifications.notifID = '.$row['notifID'].')');
                $this->table->add_row($query2->result_array()[0]['notifText'], '<a class = "waves-light waves-effect btn blue darken-4" onclick="markAsRead(\''.base_url().'\','.$row['notifID'].','.$userID.',\''.$type.'\')">Mark as Read</a>');
                $unread++;
              }
            }
            if($unread == 0){
              $db_data['unread'] = 0;
              $db_data['unreadNotifs'] = "<h5 class='center-align'>Sorry, there are no notifications to display.</h5>";
              return $db_data;
            }
            $db_data['unread'] = $unread;
            $db_data['unreadNotifs'] = $this->table->generate();
            return $db_data;
        }
    }
?>
