<?php
//defines INVOKED so the included scripts can be executed
define('INVOKED',true);

//dirname(getcwd(), 1) gets the path of app's root directory
include dirname(getcwd(), 1).'/backend/app.php';
//do any database/session actions here

?>