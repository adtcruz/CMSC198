<?php
if($_POST["username"]){
	header('Content-type:application/json;charset=utf-8');
	echo json_encode(array('username' => $_POST["username"]));
}
else die();

//defines INVOKED so the included scripts can be executed
define('INVOKED',true);

//dirname(getcwd(), 1) gets the path of app's root directory
include dirname(getcwd(), 1).'/backend/app.php';
//do any database/session actions here

?>