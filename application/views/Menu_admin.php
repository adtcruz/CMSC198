<li id="viewJRButton"><a id="viewJRItem" class="waves-effect waves-light white-text" href="<?php base_url();?>job_requests">Job Requests</a></li>
<li id="viewSchedButton"><a id="viewSchedItem" class="waves-effect waves-light white-text" href="<?php base_url();?>view_schedule">View Schedule</a></li>
<li id="genBillButton"><a id="gnrtBlItem" class="waves-effect waves-light white-text" href="<?php base_url();?>generate_bill">Generate Bill</a></li>
<li id="genBillButton"><a id="gnrtBlItem" class="waves-effect waves-light white-text" href="<?php base_url();?>generate_report">Generate Report</a></li>

<li id="mngeApButton">
    <ul class="collapsible" data-collapsible="accordion">
        <li>
            <div id="menuBody" class="collapsible-header">Manage Application</div>
            <div class="collapsible-body">
                <?php
                if (array_key_exists ('type', $_SESSION))
                {
                    if($_SESSION["type"] === "superadmin")
                    {
                        $this->load->view('superadmin_userlogs');
                    }
                }
                else
                {
                    redirect (base_url(), 'refresh');
                }
                ?>
                <a class = "waves-effect waves-light grey darken-3 white-text" href = "<?php base_url();?>manage_accounts">Manage Accounts</a>
                <a class = "waves-effect waves-light grey darken-3 white-text" href = "<?php base_url();?>manage_selectable_work">Manage Work</a>
                <a class = "waves-effect waves-light grey darken-3 white-text" href = "<?php base_url();?>manage_selectable_materials">Manage Materials</a>

                  
            </div>
        </li>
    </ul>
</li>
