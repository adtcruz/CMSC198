<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_selectable_materials_model extends CI_Model
{
    public function __construct ()
    {
        parent::__construct ();
        $this->load->database ();
    }

    public function getTable()
    {
        $query = $this->db->query ('SELECT materialID, materialName, materialDescription, materialCost, materialUnitMeasurement, active FROM materials');

        $this->table->set_heading ('Name', 'Description', 'Cost Per Unit', 'Unit of Measurement');

        foreach ($query->result_array() as $row)
        {

          $this->table->add_row ($row['materialName'], $row['materialDescription'], $row['materialCost'], $row['materialUnitMeasurement']);
        }
        return $this->table->generate();
    }
}

?>
