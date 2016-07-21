<?php
 // Initialize empty array.
$config = array();

// Set base_url for every links
$config["base_url"] = base_url()."index.php/pagination_controller/";

// Set total rows in the result set you are creating pagination for.
$config["total_rows"] = $total_row;

// Number of items you intend to show per page.
$config["per_page"] = 1;

// Use pagination number for anchor URL.
$config['use_page_numbers'] = TRUE;

//Set that how many number of pages you want to view.
$config['num_links'] = $total_row;

// Open tag for CURRENT link.
$config['cur_tag_open'] = '&nbsp;<a class="current">';

// Close tag for CURRENT link.
$config['cur_tag_close'] = '</a>';

// By clicking on performing NEXT pagination.
$config['next_link'] = 'Next';

// By clicking on performing PREVIOUS pagination.
$config['prev_link'] = 'Previous';

// To initialize "$config" array and set to pagination library.
$this->pagination->initialize($config);

// Create link.
$this->pagination->create_links();
?>

