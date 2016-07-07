<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_selectable_materials_model extends CI_Model
{
    public function __construct ()
    {
        parent::__construct ();
        $this->load->database ();
    }

    public function isSelectable($row)
    {

      if($row["active"]==1) return "<span class='green-text'>YES</span>";

      else return "<span class='red-text'>NO</span>";
    }

    public function processActions($row)
    {
      $actions = '<a class="btn-floating btn tooltipped waves-effect waves-light cyan" data-position="left" data-delay="50"';
      $actions = $actions . 'data-tooltip="Edit Selectable Material Details" onclick="openUpdateSelectableMaterialModal(\''.base_url().'\','.$row["materialID"].');"><i class="material-icons">mode_edit</i></a>&nbsp;&nbsp;';
      if($row["active"]==1){
        $actions = $actions . '<a class="btn-floating btn tooltipped waves-effect waves-light red" data-position="left" data-delay="50"';
        return $actions . 'data-tooltip="Make Selectable Material hidden" onclick="hideSelectableMaterial(\''.base_url().'\','.$row["materialID"].');"><i class="material-icons">not_interested</i></a>';
      }
      else{
        return $actions . '<a class="btn-floating btn tooltipped waves-effect waves-light green" data-position="left" data-delay="50" data-tooltip="Make Selectable Material hidden" onclick="makeSelectableMaterialModalVisible(\''.base_url().'\','.$row["materialID"].');"><i class="material-icons">launch</i></a>';

      }

    }

    public function getTable()
    {
        $query = $this->db->query ('SELECT materialID, materialName, materialDescription, materialCost, materialUnitMeasurement, active FROM materials');

        $this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));

        $this->table->set_heading ('Name', 'Description', 'Cost Per Unit', 'Unit of Measurement','Selectable?','Actions');

        foreach ($query->result_array() as $row)
        {
          $this->table->add_row ($row['materialName'],$row['materialDescription'],$row['materialCost'],$row['materialUnitMeasurement'],$this->isSelectable($row),$this->processActions($row));
        }
        return $this->table->generate();
    }
}

?>
