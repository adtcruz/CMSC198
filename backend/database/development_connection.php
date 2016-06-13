<?php
//end prematurely if the script is accessed directly
if(!defined('INVOKED')) die();

$server = "localhost";
$username = "cmsc198user";
$password = "ZNBhSKChnoTds";

$connection = new mysqli($server,$username,$password);

?>