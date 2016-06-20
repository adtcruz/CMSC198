<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>ITCBS</title>
		<meta charset="utf-8" lang="en-gb"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/material-design-icons.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/webAppMain.css"/>
	</head>
	<body>
<?php
session_start();
if(!array_key_exists("username",$_SESSION)) include "assets/pages/loginPage.html";
else {
	echo "<h3 class=\"center-align\">Logged in!</h3>\n";
	echo "<div class=\"center-align\">\n";
	echo "<a class=\"waves-effect waves-teal btn blue\" onclick=\"logOut('".base_url()."');\">Log-out</a>\n";
	echo "</div>\n";
}
?>
		<script type = "text/javascript" src = "<?php echo base_url();?>assets/js/jquery-3.0.0.min.js"></script>
		<script type = "text/javascript" src = "<?php echo base_url();?>assets/js/materialize.min.js"></script>
<?php
if(!array_key_exists("username",$_SESSION)){
	echo "<script type=\"text/javascript\" src=\"".base_url()."assets/js/login.controller.js\"></script>\n";
	echo "<script type='text/javascript'>\n";
	echo "function logIn(){\n";
	echo "\tlogInControl('".base_url()."');\n";
	echo "}\n";
	echo "</script>";
}
else{
	echo "<script type=\"text/javascript\" src=\"".base_url()."assets/js/logout.controller.js\"></script>\n";
}
?>	
	</body>
</html>