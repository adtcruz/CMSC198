<?php

class Get_materials_used_model extends CI_Model
{
	public function __construct ()
	{
		parent::__construct ();
	}

  public function processActions($materialsUsedID){
		$editOpen = '<a class="btn-floating btn tooltipped waves-effect waves-light cyan" data-position="left" data-delay="50" data-tooltip="Change material quantity/unit"';
		$editFunctionCall = ' onclick="updateMaterialsUsed(\''.base_url().'\','.$materialsUsedID.')"';
		$editClose = '><i class="material-icons">mode_edit</i></a>';
		$space = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$deleteOpen = '<a class="btn-floating btn tooltipped waves-effect waves-light red" data-position="left" data-delay="50" data-tooltip="Delete material used"';
		$deleteFunctionCall = ' onclick="deleteMaterialUsed(\''.base_url().'\','.$materialsUsedID.')"';
		$deleteClose = '><i class="material-icons">not_interested</i></a>';
		return $editOpen . $editFunctionCall . $editClose . $space . $deleteOpen . $deleteFunctionCall . $deleteClose;
  }
}
