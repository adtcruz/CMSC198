<?php
    class Notifications_model extends CI_Model
    {
        public function __construct ()
        {
            parent::__construct ();
            $this->load->database ();
        }

        private function getUserID ($username, $type)
        {
            $userID = '';
            switch ($type)
            {
                case 'client':
                    $query = $this->db->query ('SELECT clientID FROM client WHERE (username = "'.$username.'")');
                    $userID = $query->result_array()[0]['clientID'];
                break;
                case 'technician':
                case 'admin':
                    $query = $this->db->query ('SELECT adminID FROM adminAcc WHERE (username = "'.$username.'")');
                    $userID = $query->result_array()[0]['adminID'];
                break;
                case 'superadmin':
                    $query = $this->db->query ('SELECT superAdminID FROM superAdmin WHERE (username = "'.$username.'")');
                    $userID = $query->result_array()[0]['superAdminID'];
                break;
                default: redirect (base_url(), 'refresh');
            }
            return $userID;
        }

        public function getUnreadCount ($username, $type)
        {
            $userID = $this->getUserID ($username, $type);
            $unread = 0;
            switch ($type)
            {
                case 'client':
                    $query = $this->db->query ('SELECT notifID FROM notifications WHERE (createdByType != "client") AND (clientID = "'.$userID.'")');
                    if ($this->db->affected_rows () == 0)
                    {
                        $unread = "client";
                        return $unread;
                    }
                    else
                    {
                        $rows = $query->result_array ();
                        foreach ($rows as $row)
                        {
                            $this->db->query ('SELECT notifsRead.notifID, notifsRead.userID FROM notifsRead WHERE (notifsRead.userType = "client") AND (notifsRead.notifID = '.$row['notifID'].') AND (notifsRead.userID = "'.$userID.'")');
                            if ($this->db->affected_rows () == 0)
                            {
                                $unread ++;
                            }
                        }
                        return $unread;
                    }
                break;
                case 'technician':
                case 'admin':
                case 'superadmin':
                    $rows = $this->db->query ('SELECT notifID FROM notifications WHERE (createdByType = "client")')->result_array ();
                    if ($this->db->affected_rows () == 0)
                    {
                        return $unread;
                    }
                    else
                    {
                        foreach ($rows as $row)
                        {
                            $this->db->query ('SELECT notifsRead.userID FROM notifsRead WHERE (notifsRead.notifID = '.$row['notifID'].') AND (notifsRead.userID = '.$userID.') AND (notifsRead.userType = "'.$type.'")');
                            if ($this->db->affected_rows () == 0)
                            {
                                $unread++;
                            }
                        }
                        return $unread;
                    }
                break;
                default: redirect (base_url(), 'refresh');
            }
        }

        public function getClientUnreadNotifs ($username, $type)
        {
            $userID = $this->getUserID ($username, $type);
            $this->table->clear ();
            $this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));
            $this->table->set_heading("Notification Details","");
            $rows = $this->db->query ('SELECT notifID FROM notifications WHERE (createdByType != "client") AND (clientID = '.$userID.')')->result_array ();

            if ($this->db->affected_rows () == 0)
            {
                $db_data['unreadNotifs'] = "<h5 class='center-align'>Sorry, there are no notifications to display.</h5>";
                return $db_data;
            }
            else
            {
                foreach ($rows as $row)
                {
                    $this->db->query ('SELECT notifsRead.notifID, notifsRead.userID FROM notifsRead WHERE (notifsRead.userType = "client") AND (notifsRead.notifID = '.$row['notifID'].') AND (notifsRead.userID = "'.$userID.'")');
                    if ($this->db->affected_rows () == 0)
                    {
                        $query = $this->db->query ('SELECT notifText FROM notifications WHERE (notifID = '.$row['notifID'].')');
                        $this->table->add_row ($query->result_array()[0]['notifText'], '<a class = "waves-light waves-effect btn blue darken-4" onclick="markAsRead(\''.base_url().'\','.$row['notifID'].','.$userID.',\'client\')">Mark as Read</a>');
                    }
                }
            }
            $db_data['unreadNotifs'] = $this->table->generate ();
            return $db_data;
        }

        public function notifBillGenerated ($username, $jobID)
        {
            // get client details using username
            $query = $this->db->query ('SELECT givenName, lastName, clientID FROM client WHERE (client.username = "'.$username.'")');
            $clientFN = $query->result_array ()[0]['givenName'];
            $clientLN = $query->result_array ()[0]['lastName'];
            $clientID = $query->result_array ()[0]['clientID'];

            // get officeAbbr of client;
            $query = $this->db->query ('SELECT office.officeAbbr FROM office, client WHERE (client.username = "'.$username.'") AND (client.officeID = office.officeID)');
            $officeAbbr = $query->result_array ()[0]['officeAbbr'];

            // get date created of job
            $query = $this->db->query ('SELECT dateCreated FROM job WHERE (jobID = '.$jobID.')');
            $date = $query->result_array()[0]['dateCreated'];

            // check if bill has been already generated
            $this->db->query ('SELECT notifications.clientID, notifications.jobID FROM notifications WHERE (notifications.clientID = '.$clientID.') AND (notifications.jobID = '.$jobID.') AND (notifications.createdByType = "client")');

            // if there is an entry that already exists, ignore. else, insert notification
            if ($this->db->affected_rows () == 1)
            {
                echo 'Already exists';
                return;
            }
            else
            {
                $string = "$clientFN $clientLN of $officeAbbr has generated the bill for job dated $date";
                $this->db->query ('INSERT INTO notifications(notifText, dateCreated, createdBy, createdByType, clientID,jobID) VALUES ("'.$string.'", CURDATE(), '.$clientID.', "client",'.$clientID.','.$jobID.')');
                if ($this->db->affected_rows () == 1)
                {
                    echo 'Inserted!';
                }
                else
                {
                    echo 'Not Inserted';
                }
            }
        }

        public function getReadNotifs ($username, $type)
        {
            // get user ID. use type to easily determine where to get said id
            $userID = $this->getUserID ($username, $type);

            // set table template
            $this->table->clear ();
            $this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));
            $this->table->set_heading("Notification Details");
            $notifs = array ();

            // get all notifs read
            $query = $this->db->query ('SELECT notifsRead.notifID, notifsRead.userID, notifsRead.userType FROM notifsRead WHERE (notifsRead.userID = '.$userID.') AND (notifsRead.userType = "'.$type.'")');
            $notifs = $query->result_array ();

            // if the result of the query is not empty, proceed in retrieving the needed notifications
            if (!empty ($notifs))
            {
                // foreach notifs, select those where userID = $userID and notifReadID = notifID (to get proper notifs)
                foreach ($notifs as $row)
                {
                    $query = $this->db->query ('SELECT notifications.notifText FROM notifications, notifsRead WHERE (notifsRead.userID = '.$userID.') AND (notifications.notifID = '.$row['notifID'].')');
                    if ($this->db->affected_rows () > 0 && isset ($query->result_array ()[0]['notifText']))
                    {
                        $this->table->add_row ($query->result_array ()[0]['notifText']);
                    }
                }

                $db_data['table'] = $this->table->generate ();
            }
            else
            {
                $db_data['table'] = '<h5 class="center-align">Sorry, there are no notifications to display.</h5>';
            }
            return $db_data;
        }

        public function getUnreadNotifs ($username, $type)
        {
            // get userID based on usertype and username
            $userID = $this->getUserID ($username, $type);

            // clear table variable then set table properties
            $this->table->clear ();
            $this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));
            $this->table->set_heading("Notification Details","");
            $rows = $this->db->query('SELECT notifID FROM notifications WHERE (createdByType = "client")')->result_array();

            if($this->db->affected_rows() == 0)
            {
                $db_data['unreadNotifs'] = "<h5 class='center-align'>Sorry, there are no notifications to display.</h5>";
                return $db_data;
            }
            foreach($rows as $row)
            {
                $this->db->query('SELECT notifsRead.userID FROM notifsRead WHERE (notifsRead.notifID = '.$row['notifID'].') AND (notifsRead.userID = '.$userID.') AND (notifsRead.userType = "'.$type.'")');
                if($this->db->affected_rows() == 0)
                {
                    $query2 = $this->db->query('SELECT notifications.notifText FROM notifications WHERE (notifications.notifID = '.$row['notifID'].')');
                    $this->table->add_row($query2->result_array()[0]['notifText'], '<a class = "waves-light waves-effect btn blue darken-4" onclick="markAsRead(\''.base_url().'\','.$row['notifID'].','.$userID.',\''.$type.'\')">Mark as Read</a>');
              }
            }
            $db_data['unreadNotifs'] = $this->table->generate ();
            return $db_data;
        }
    }
?>
