<?php
session_start();
if(!array_key_exists("username", $_SESSION)){
	include 'frontend/views/landingPage.html';
}
else {
	include 'frontend/views/home.html';
}
?>