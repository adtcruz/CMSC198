<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/generate-report.css"/>
<div class = "row" style = "width: 800px;">
    <div class = "col s1 m1 l1"> &nbsp; </div>
    <div class = "col s10 m10 l10">
        <?php
            $this->load->view ('Header');

            // UP Logo
        	$upLogoCell = array (
        			'data' => '<img src = "assets/images/up_logo.png">',
        			'rowspan' => '4',
        			'class' => 'center-align'
        		);

            // ITC Logo
        	$itcLogoCell = array (
        			'data' => '<img src = "assets/images/itc_logo.jpg" witdh = "120" height = "120">',
        			'rowspan' => '4',
                    'class' => 'center-align'
                );

            $this->table->add_row ($itcLogoCell, array ('data' => 'University of the Philippines Los Banos', 'align' => 'center'),$upLogoCell);
            $this->table->add_row (array('data' => '<b>Information Technology Center</b>', 'align' => 'center'));
            $this->table->add_row (array('data' => 'Office of the Vice Chancellor for Planning and Development', 'align' => 'center'));
            $this->table->add_row (array('data' => 'Rm 206 Abelardo Samonte Hall, UPLB, College, Laguna', 'align' => 'center'));

            echo $this->table->generate ();
        ?>
    </div>
    <div class = "col s1 m1 l1"> &nbsp; </div>
</div>
