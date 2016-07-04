<?php
/*
* file: Bill_for_payment_view.php
*   This file is the code representation of the PDF to be generated as the Bill for Payment.
*   It makes use of the MPDF plugin to genrate the needed PDF.
*/
// restrict direct access
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // set template for the table
    $template = array (
			'table_open' => '<table width = "800">'
		);

    // apply said template to table
	$this->table->set_template ($template);

    // create an image cell with the following parameters
	$upLogoCell = array (
        // refers to the content of the cell
		'data' => '<img src = "assets/images/up_logo.png">',
        // corresponds to the HTML rowspan attribute
        'rowspan' => '4'
	);

    // another image cell
	$itcLogoCell = array (
		'data' => '<img src = "assets/images/itc_logo.jpg" witdh = "120" height = "120">',
		'rowspan' => '4'
	);

    // adds rows to the table. this entire block is the header of the document
	$this->table->add_row ($upLogoCell, array ('data' => 'University of the Philippines Los Baños', 'align' => 'center'), $itcLogoCell);
	$this->table->add_row (array('data' => '<b>Information Technology Center</b>', 'align' => 'center'));
	$this->table->add_row (array('data' => 'Office of the Vice Chancellor for Planning and Development', 'align' => 'center'));
	$this->table->add_row (array('data' => 'Rm 206 Abelardo Samonte Hall, UPLB, College, Laguna', 'align' => 'center'));

    // generate the HTML code for this table
    echo $this->table->generate ();
    // clear the CI table variable. you need to clear the variable when you need to create a new table
	$this->table->clear ();

    // set another template for another table. this is needed since the variable is reset
    $template = array (
		'table_open' => '<table width = "800">'
	);
    // apply said template
	$this->table->set_template ($template);
    // set empty cells to contain '&nbsp;' -> non-breaking space
	$this->table->set_empty ('&nbsp;');
    // add empty cell. all cells of this format are treated as empty cells
	$this->table->add_row ('');
    // appends the bill number
	$this->table->add_row (array ('data' => 'Bill No. '.date('Ydm').' - '.$jobID, 'align' => 'right'));
    // appends the date
	$this->table->add_row (array ('data' => 'Date: '.date ('M d, Y').'', 'align' => 'right'));

    // generate the html code
    echo $this->table->generate ();
    // clear the variable again
	$this->table->clear ();

    // set another template
    $template = array (
			'table_open' => '<table width = "800">'
		);
    // apply the template
	$this->table->set_template ($template);
    // set empty cells to contain non-breaking space
	$this->table->set_empty ('&nbsp;');
	$this->table->add_row ('');

    // append the client details
    $this->table->add_row (array ('data' => ''.$givenName.' '.$lastName.'', 'align' => 'left'));
	$this->table->add_row (array ('data' => ''.$officeAbbr.'', 'align' => 'left'));
	$this->table->add_row (array ('data' => ''.$officeName.'', 'align' => 'left'));
	$this->table->add_row ('');

    // generate HTML code
    echo $this->table->generate ();
    // clear variable
    $this->table->clear ();

    // set and apply template
    $template = array (
		'table_open' => '<table width = "800" border = "1">'
	);
	$this->table->set_template ($template);

    // append the information regarding the job
    // job details
    $this->table->add_row (array ('data' => 'Job Request No.', 'align' => 'center'), array ('data' => 'Description', 'align' => 'center'), array ('data' => 'Amount', 'align' => 'center'));

	$this->table->add_row (array ('data' => ''.$jobID.'', 'align' => 'center'), array ('data' => '<b>'.$jobDescription.'</b>', 'align' => 'center'),'');

    // job total cost
	$this->table->add_row (array ('data' => '<b>Total Amount Due</b>', 'colspan' => '2', 'align' => 'right'), array('data' => 'PHP'.($totalCost).'', 'align' => 'center'));

    // generate HTML code
    echo $this->table->generate ();
    // clear variable
    $this->table->clear ();

    // set and apply template
	$template = array (
		'table_open' => '<table width = "800">'
	);
	$this->table->set_template ($template);
    // set all empty cells to contain non-breaking space
	$this->table->set_empty ('&nbsp;');

    // append the footer of the document
    $this->table->add_row ('');
	$this->table->add_row ('Please prepare the payment to the account of Information Technology Center (Acct. No. 8217200). If you have any questions concerning this statement, please call us at (049)501-4591, 536-2886 opt. 2, VoIP #100.');

    $this->table->add_row ('');
	$this->table->add_row ('');
	$this->table->add_row ('');

    // the ITC director's name depends on the office table in the database of this application
	$this->table->add_row ('<b>'.$head.'</b>');
	$this->table->add_row ('Director');

    // generate the HTML code
	echo $this->table->generate ();
?>
