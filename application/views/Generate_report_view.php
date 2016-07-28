<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if (array_key_exists ("type", $_SESSION))
    {
        if ($_SESSION['type'] == 'superadmin')
        {
            $this->load->view ('Header');
            $this->load->view ('Navbar');
            $this->load->view ('Generate_report_view_form', $unread);
            $this->load->view ('Generate_report_scripts');
            $this->load->view ('Logout_script');
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
?>
</body>
</html>
