<!--
-   file: Generate_bill_Dash.php
-       This view generates the job ID, name of client and buttons for generating
-       the bill for payment and job request form
-->
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
    <div class="row">
        <!-- load side menu -->
        <?php $this->load->view('Sidenav', $unread);?>
        <div id="mainc" class="container">
            <div class="row">
                <form autocomplete="off">
                <br/>
    			<h4 class="center-align">Generate Bill</h4>
    			<br/>
    			<?php
                    $this->load->library ('table');
    				$template = array(
                        'table_open' => '<table class="bordered centered highlight">'
    				);
    				$this->table->set_template ($template);
    				$this->table->set_heading ('Job ID', 'Client Name', '');
                    /* if there are no finished jobs, display this line */
                    if(count($generateBill_array) == 0)
                    {
                        echo "<h5 class=\"center-align\">Sorry, there are no finished jobs at the moment.</h5>";
    					return;
    				}
                    /* else, for each finished job, generate a table row with the job ID, name of client and the buttons that will create a PDF
                    of the bill and the job request */
    				foreach ($generateBill_array as $row)
                    {
                        $this->table->add_row (
                            $row['jobID'],
                            $row['givenName'].' '.$row['lastName'],
                            '<a href = "topdf_bfp/'.$row['jobID'].'" target = "_blank" class= "waves-effect waves-light btn blue-grey">Generate Bill</a>'
                        );
    				}
    				echo $this->table->generate ();
    			?>
    			<br/>
    			<br/>
    			</form>
    		</div>
	    </div>
    </div>
</body>
</html>
