<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	$template = array (
			'table_open' => '<table style = "text-align: center;" width = "800">'
		);
	$this->table->set_template ($template);

	// UP Logo
	$upLogoCell = array (
			'data' => '<img src = "assets/images/up_logo.png">',
			'rowspan' => '4',
			'filter' => 'grayscale (100%)',
			'-webkit-filter' => 'grayscale (100%)'
		);
	// ITC Logo
	$itcLogoCell = array (
			'data' => '<img src = "assets/images/itc_logo.jpg" witdh = "120" height = "120">',
			'rowspan' => '4',
			'filter' => 'grayscale (100%)',
			'-webkit-filter' => 'grayscale (100%)'
		);
	// PDF Header
	$this->table->add_row ($upLogoCell, array ('data' => 'University of the Philippines Los Banos', 'align' => 'center'), $itcLogoCell);
	$this->table->add_row (array('data' => '<b>Information Technology Center</b>', 'align' => 'center'));
	$this->table->add_row (array('data' => 'Office of the Vice Chancellor for Planning and Development', 'align' => 'center'));
	$this->table->add_row (array('data' => 'Rm 206 Abelardo Samonte Hall, UPLB, College, Laguna', 'align' => 'center'));
	echo $this->table->generate ();
	$this->table->clear ();

	$template = array (
			'table_open' => '<table width = "800" border = "1" style = "text-align: center;">'
		);
	$this->table->set_template ($template);

    if (empty ($result_array))
    {
        $this->table->add_row ("There are no tasks found");
    }
    else
    {
        // Table Header
        $this->table->set_heading ('Date', 'Office / Unit', 'Job Description', 'Finish Date');
    	$this->table->set_empty ('&nbsp;');

    	// Table Contents, data retrieved from database
    	foreach ($result_array as $row)
    	{
    		$this->table->add_row ($row['dateCreated'], $row['officeAbbr'], $row['jobDescription'], $row['finishDate']);
    	}
    }

	echo $this->table->generate ();
	$this->table->clear ();
?>
