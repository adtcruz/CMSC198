<?php
/*
This will make full use of CodeIgniter's table class.
*/
	/* start header table render */
	$cell = array (
		'data' => '<img src = "assets/images/itc_logo.jpg" width = "100" height = "100">',
		'rowspan' => "5"
		); // similar to <td rowspan = 5> <img> </td>

	$this->table->add_row ($cell, '<b> UPLB Information Technology Center', '(Accomplish in Duplicate)');
	$this->table->add_row ('University of the Philippines Los Banos', 'Job Request No.');
	$this->table->add_row ('Job Request Form', 'Date: '.date ('M d, Y')); // outputs current date in Month Date Year
	$this->table->add_row ('Tel.No.: (049) 501-4591, 536-2886 VoIP: #100', 'Job Start Date: ');
	$this->table->add_row ('Email: itc@uplb.edu.ph', 'Job Finish Date: ');
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
	$this->table->add_row ('Printed Name: '.$name.'', 'Designation: '.$designation.'');
	$this->table->add_row ('Office/Unit: '.$officeAbbr.'', 'Tel.No.: '.$telNo.'');

	$cell = array (
			'data' => 'Location of Work: '.$officeName.'',
			'colspan' => '2'
		);
	$this->table->add_row ($cell);

	$cell = array (
			'data' => 'Work to be Done/Problem encountered: '.$problem.'',
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
	$this->table->add_row ('Description', 'Rate', 'Duration' ,'Total Cost');

    $totalCost = 0;
    foreach ($workDone as $row)
    {
        $this->table->add_row ($row['description'], $row['rate'], $row['duration'], $row['rate']*$row['duration']);
        $totalCost += ($row['rate']*$row['duration']);
    }
    $this->table->add_row ('', '', 'Total Cost', $totalCost);

	echo $this->table->generate ();
	$this->table->clear ();
	/* end services info table render */

	/* start bill of materials table render */
	$this->table->set_template (
		array (
			'table_open' => '<table border = "1" width = "100%">'
			)
		);
	$cell = array (
			'data' => 'Bill of Materials',
			'colspan' => '3'
		);
	$this->table->set_heading ($cell);
	$this->table->add_row ('Description', 'Quantity/Unit', 'Cost per Unit');
	$this->table->add_row (array ('data' => 'Materials Used', 'colspan' => '3', 'align' => 'center'));

    $totalCost = 0;
    foreach ($materialsUsed as $row)
    {
        $this->table->add_row ($row['description'], $row['units'], $row['cost']);
        $totalCost += ($row['units']*$row['cost']);
    }
    $this->table->add_row ('', 'Total Cost', $totalCost);

	$this->table->add_row (array ('data' => 'Materials Harvested', 'colspan' => '3', 'align' => 'center'));
	echo $this->table->generate ();
	$this->table->clear ();
	/* end bill of materials table render */

	/* start recommended materials table render */
	$this->table->set_template (
		array (
			'table_open' => '<table border = "1" width = "100%">'
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
