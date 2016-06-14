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
	echo "<h3 class='center-align'>Logged in!</h3>\n";
	echo "<div class='center-align'>\n";
	echo "<a class='waves-effect waves-teal btn blue' onclick='logout();'>Log-out</a>\n";
	echo "</div>\n";
}
?>
		<script type = "text/javascript" src = "<?php echo base_url();?>assets/js/jquery-3.0.0.min.js"></script>
		<script type = "text/javascript" src = "<?php echo base_url();?>assets/js/materialize.min.js"></script>
<?php
if(!array_key_exists("username",$_SESSION)){
	echo "<script type='text/javascript'>\n";
	echo "$(document).ready(\n";
	echo "function(){\n";
	echo "if(!($('body').hasClass('red')&&$('body').hasClass('darken-1'))){\n";
	echo "$('body').addClass('red');\n$('body').addClass('darken-1')\n}\n";
	echo "});\n";
	echo "function logIn(){\n";
	echo "$.post('".base_url()."login/',{ 'username':usernameInput.value , 'password':passwordInput.value }, function(data){\n";
	echo "if(data==='Logged-on'){\n";
	echo "window.location.href = '".base_url()."';\n";
	echo "}\n";
	echo "else if(data==='Invalid password'){\n";
	echo "}\n";
	echo "else if(data==='Invalid credentials'){\n";
	echo "Materialize.toast('Invalid password!',3000);\n";
	echo "}\n";
	echo "});\n";
	echo "}\n";
	echo "</script>";
}
else{
	echo "<script type='text/javascript'>\n";
	echo "function logout(){\n";
	echo "$.get('".base_url()."logout/',function(data){;\n";
	echo "window.location.href = '".base_url()."';\n";
	echo "});\n";
	echo "}\n";
	echo "</script>";
}
?>	
	</body>
</html>