<?php

class Get_work_done_model extends CI_Model
{
	public function __construct ()
	{
		parent::__construct ();
	}

  public function processActions($workDoneID){
		$editOpen = '<a class="btn-floating btn tooltipped waves-effect waves-light cyan" data-position="left" data-delay="50" data-tooltip="Change work duration"';
		$editClose = '><i class="material-icons">mode_edit</i></a>';
		$space = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$deleteOpen = '<a class="btn-floating btn tooltipped waves-effect waves-light red" data-position="left" data-delay="50" data-tooltip="Delete work done"';
		$deleteFunctionCall = 'onclick="deleteWorkDone(\''.base_url().'\','.$workDoneID.')"';
		$deleteClose = '><i class="material-icons">not_interested</i></a>';
		return $editOpen . $editClose . $space . $deleteOpen . $deleteFunctionCall . $deleteClose;
  }

	public function processRate($rate){
		if ($rate==0) return "No charge";
		return $rate . " per hour";
	}

	public function processCost($rate,$workDuration){
		if($rate==0) return "No charge";
		return $rate*$workDuration;
	}
}
