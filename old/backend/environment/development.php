<?php
//checks if INVOKED was defined by a calling script
//if it was not defined, it means the script is accessed directly
//end prematurely if the script is accessed directly
if(!defined('INVOKED')) die();

//gets the development environment database script settings
include dirname(getcwd(), 1).'/backend/database/development_connection.php'
?>