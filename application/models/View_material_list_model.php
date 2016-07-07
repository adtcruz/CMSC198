<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_material_list_model extends CI_Model
{
    public function __construct ()
    {
        parent::__construct ();
        $this->load->database ();
    }

    public function getMaterials ()
    {
        $query = $this->db->query ('SELECT materials.materialName, materials.materialDescription, materials.materialCost, materials.materialUnitMeasurement FROM materials WHERE (materials.active = 1)');

        $this->table->set_heading ('Name', 'Description', 'Cost Per Unit', 'Unit of Measurement');

        foreach ($query->result_array () as $row)
        {
            $this->table->add_row ($row['materialName'], $row['materialDescription'], $row['materialCost'], $row['materialUnitMeasurement']);
        }
    }
}

?>
