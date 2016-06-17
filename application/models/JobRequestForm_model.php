<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class JobRequestForm_model extends CI_Model
{
	public $db_data;

	public function __construct ()
	{
		parent::__construct ();
		$this->load->database ();
	}

	public function getData ()
	{
		session_start();
		$username = '\''.$_SESSION['username'].'\'';
		$db_data['givenName'] = $this->db->query ('SELECT givenName FROM technician WHERE username = '.$username.'')->row()->givenName;
		$db_data['lastName'] = $this->db->query ('SELECT lastName FROM technician WHERE username = '.$username.'')->row()->lastName;
		return $db_data;
	}
}
?>