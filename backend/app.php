<?php
//checks if INVOKED was defined by a calling script
//if it was not defined, it means the script is accessed directly
//end prematurely if the script is accessed directly
if(!defined('INVOKED')) die();

//Set APPENV to 'development' for development environment
//For production environment, set APPENV to 'production'
$APPENV = 'development';


if ($APPENV === 'development'){
	//use the development environment script
	include dirname(getcwd(), 1).'/backend/environment/development.php';
}
elseif ($APPENV === 'production'){
	//use the production environment script
	include dirname(getcwd(), 1).'/backend/environment/production.php';
}
?>