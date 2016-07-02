<?php

class Get_materials_used_model extends CI_Model
{
	public function __construct ()
	{
		parent::__construct ();
	}

  public function processActions($materialsUsedID){
		$editOpen = '<a class="btn-floating btn tooltipped waves-effect waves-light cyan" data-position="left" data-delay="50" data-tooltip="Edit material used"';
		$editClose = '><i class="material-icons">mode_edit</i></a>';
		$space = '&nbsp;&nbsp';
		$deleteOpen = '<a class="btn-floating btn tooltipped waves-effect waves-light red" data-position="left" data-delay="50" data-tooltip="Delete material used"';
		$deleteClose = '><i class="material-icons">not_interested</i></a>';
		return $editOpen . $editClose . $space . $deleteOpen . $deleteClose;
  }
}
