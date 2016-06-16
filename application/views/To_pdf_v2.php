<?php
/*
This will make full use of CodeIgniter's table class.
*/	
	session_start ();
	/* start header table render */
	$cell = array (
		'data' => '<img src = "assets/images/logo.jpg">', 'rowspan' => "5"
		); // similar to <td rowspan = 5> <img> </td>
	$this->table->add_row ($cell, '<b> UPLB Information Technology Center', '(Accomplish in Duplicate)');
	$this->table->add_row ('University of the Philippines Los Banos', 'Job Request No.');
	$this->table->add_row ('Job Request Form', 'Date: '.date ('M d, Y')); // outputs current date in Month Date Year
	$this->table->add_row ('Telephone', 'Time Finished');
	$this->table->add_row ('Email', 'Time Started');
	echo $this->table->generate (); // generates the table
	$this->table->clear(); // clears the previously entered table data
	/* end header table render */

	/* start client info table render */
	$this->table->set_template (
		array (
			'table_open' => '<table border = "1" width = "100%">'
			)
		); // set table template. add border to table
	$cell = array (
			'data' => 'Client Info',
			'colspan' => '2'
		); // <td colspan = "2"> text </td>

	$this->table->set_heading ($cell); //<<th> data </th>
	$this->table->add_row ('Printed Name: '.$_SESSION['username'].'', 'Designation');
	$this->table->add_row ('Office/Unit:', 'Tel.No.:');

	$cell = array (
			'data' => 'Location of Work:',
			'colspan' => '2'
		);
	$this->table->add_row ($cell);

	$cell = array (
			'data' => 'Work to be Done/Problems encountered: ',
			'colspan' => '2'
		);
	$this->table->add_row ($cell);
	echo $this->table->generate ();
	$this->table->clear ();
	/* end client info table render */

	/* start services info table render */
	$this->table->set_template (
		array (
			'table_open' => '<table border = "1" width = "100%">'
			)
		);
	$cell = array (
			'data' => 'Services Info',
			'colspan' => '4'
		);
	$this->table->set_heading ($cell);
	$this->table->add_row ('Description', 'Quantity', 'Cost per Unit', 'Total Cost');
	echo $this->table->generate ();
	$this->table->clear ();
	/* end services info table render */

	/* start bill of materials table render */
	$this->table->set_template (
		array (
			'table_open' => '<table border = "1" width = "100%">',
			'cell_start' => '<th>',
			'cell_end' => '</th>'
			)
		);
	$cell = array (
			'data' => 'Bill of Materials',
			'colspan' => '4'
		);
	$this->table->set_heading ($cell);
	$this->table->add_row ('Description', 'Remarks', 'Quantity/Unit', 'Cost per Unit');
	$this->table->add_row ('Materials Used', '','','');
	$this->table->add_row ('Materials Harvested', '','','');
	echo $this->table->generate ();
	$this->table->clear ();
	/* end bill of materials table render */

	/* start recommended materials table render */
	$this->table->set_template (
		array (
			'table_open' => '<table border = "1" width = "100%">',
			'cell_start' => '<th>',
			'cell_end' => '</th>'
			)
		);
	$cell = array (
			'data' => 'Recommended Materials/Equipment for Purchase',
			'colspan' => '3'
		);
	$this->table->set_heading ($cell);
	$this->table->add_row ('Item Specification', 'Quantity/Unit', 'Cost per Unit');
	echo $this->table->generate ();
	$this->table->clear ();
	/* end recommended materials table render */

?>