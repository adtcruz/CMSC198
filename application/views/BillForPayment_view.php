<?php
// restrict direct access
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$template = array (
			'table_open' => '<table width = "800">'
		);
	$this->table->set_template ($template);

	$upLogoCell = array (
			'data' => '<img src = "assets/images/up_logo.png">',
			'rowspan' => '4'
		);

	$itcLogoCell = array (
			'data' => '<img src = "assets/images/itc_logo.jpg" witdh = "120" height = "120">',
			'rowspan' => '4'
		);

	$this->table->add_row ($upLogoCell, array ('data' => 'University of the Philippines Los Banos', 'align' => 'center'), $itcLogoCell);
	$this->table->add_row (array('data' => '<b>Information Technology Center</b>', 'align' => 'center'));
	$this->table->add_row (array('data' => 'Office of the Vice Chancellor for Planning and Development', 'align' => 'center'));
	$this->table->add_row (array('data' => 'Rm 206 Abelardo Samonte Hall, UPLB, College, Laguna', 'align' => 'center'));
	echo $this->table->generate ();
	$this->table->clear ();

	$template = array (
			'table_open' => '<table width = "800">'
		);
	$this->table->set_template ($template);
	$this->table->set_empty ('&nbsp;');
	$this->table->add_row ('');
	$this->table->add_row (array ('data' => 'Bill No. '.$jobID, 'align' => 'right'));
	$this->table->add_row (array ('data' => 'Date: '.date ('M d, Y').'', 'align' => 'right'));
	echo $this->table->generate ();
	$this->table->clear ();

	$template = array (
			'table_open' => '<table width = "800">'
		);
	$this->table->set_template ($template);
	$this->table->set_empty ('&nbsp;');
	$this->table->add_row ('');

	$this->table->add_row (array ('data' => ''.$givenName.' '.$lastName.'', 'align' => 'left'));
	$this->table->add_row (array ('data' => ''.$officeAbbr.'', 'align' => 'left'));
	$this->table->add_row (array ('data' => ''.$officeName.'', 'align' => 'left'));
	$this->table->add_row ('');
	echo $this->table->generate ();
	$this->table->clear ();

	$template = array (
			'table_open' => '<table width = "800" border = "1">'
		);
	$this->table->set_template ($template);
	$this->table->add_row (array ('data' => 'Job Request No.', 'align' => 'center'), array ('data' => 'Description', 'align' => 'center'), array ('data' => 'Amount', 'align' => 'center'));
	$this->table->add_row (array ('data' => ''.$jobID.'', 'align' => 'center'), array ('data' => '<b>'.$jobDescription.'</b>', 'align' => 'center'), 	array ('data' => 'PHP '.$totalCost.'', 'align' => 'center'));
	$this->table->add_row (array ('data' => '<b>Total Amount Due</b>', 'colspan' => '2', 'align' => 'right'), array('data' => 'PHP'));
	echo $this->table->generate ();
	$this->table->clear ();

	$template = array (
			'table_open' => '<table width = "800">'
		);
	$this->table->set_template ($template);
	$this->table->set_empty ('&nbsp;');
	$this->table->add_row ('Please prepare the payment to the account of Information Technology Center (Acct. No. 8217200). If you have any question concerning this statement, please call us at (049)501-4591, 536-2886 opt. 2, VoIP #100.');
	$this->table->add_row ('');
	$this->table->add_row ('');
	$this->table->add_row ('');

	$this->table->add_row ('<b>'.$head.'</b>');
	$this->table->add_row ('Director');
	echo $this->table->generate ();
?>
