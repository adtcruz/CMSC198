<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_selectable_work_model extends CI_Model
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
      $actions = $actions . 'data-tooltip="Edit Selectable Work Details" onclick="openUpdateSelectableWorkModal(\''.base_url().'\','.$row["workID"].')"><i class="material-icons">mode_edit</i></a>&nbsp;&nbsp;';
      if($row["active"]==1){
        $actions = $actions . '<a class="btn-floating btn tooltipped waves-effect waves-light red" data-position="left" data-delay="50"';
        return $actions . 'data-tooltip="Make Selectable Work hidden" onclick="hideSelectableWork(\''.base_url().'\','.$row["workID"].')"><i class="material-icons">not_interested</i></a>';
      }
      else{
        return $actions . '<a class="btn-floating btn tooltipped waves-effect waves-light green" data-position="left" data-delay="50" data-tooltip="Make Selectable Work visible" onclick="makeSelectableWorkVisible(\''.base_url().'\','.$row["workID"].')"><i class="material-icons">launch</i></a>';

      }

    }

    public function getTable()
    {
        $query = $this->db->query ('SELECT workID, workDescription, workCost, active FROM work');

        $this->table->set_template(array('table_open' =>'<table class="bordered centered highlight responsive-table">'));

        $this->table->set_heading ('Work Description','Cost','Selectable?','Actions');

        if (count($query->result_array())==0){
          return '<h5 class="center-align">Sorry, there are no selectable work yet.</h5>';
        }

        foreach ($query->result_array() as $row)
        {
          $this->table->add_row ($row['workDescription'],$row['workCost'],$this->isSelectable($row),$this->processActions($row));
        }
        return $this->table->generate();
    }
}

?>
