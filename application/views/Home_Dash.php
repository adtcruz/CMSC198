<?php
	if($_SESSION["type"]==="client") $this->load->view('Home_Dash_Client');
		
	if($_SESSION["type"]==="technician") $this->load->view('Home_Dash_Technician');

	if($_SESSION["type"]==="admin") $this->load->view('Home_Dash_Admin');

	if($_SESSION["type"]==="superadmin") $this->load->view('Home_SuperAdmin');	
?>