<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_materials_controller extends CI_Controller
{
    public function __construct ()
    {
        parent::__construct ();
        $this->load->model ('Add_materials_model', 'adm');
        $this->load->library ('form_validation');
    }

    public function index ()
    {
        session_start ();
        if (array_key_exists ("username", $_SESSION))
        {
            if ($_SESSION['type'] != 'client')
            {
                $materialDescription = $this->input->post ('materialDescription');
                $materialCost = $this->input->post ('materialCost');
                $materialUnitMeasurement = $this->input->post ('materialUnitMeasurement');

                $this->form_validation->set_rules ('materialDescription', 'Material Description', 'trim|required|callback_checkIfMaterialExists',
                array (
                    'checkIfMaterialExists' => 'Material Already Exists'
                )
                );
                $this->form_validation->set_rules ('materialCost', 'Material Cost', 'trim|required|callback_checkIfNumber', array (
                    'checkIfNumber' => 'Input is not a number'
                )
                );

                if ($this->form_validation->run () == FALSE)
                {
                    $this->load->view ('Add_material_view');
                }
                else
                {

                }
            }
            else
            {
                show_404();
            }
        }
    }

    public function checkIfNumber ($str)
    {
        $pattern = '/^[0-9]+(.)?[0-9]+$/';
        if (preg_match ($pattern, $str))
            return TRUE;
        else
            return FALSE;
    }

    public function checkIfMaterialExists ($str)
    {
        $query = $this->db->query ('SELECT materials.materialName FROM materials WHERE materials.materialName = "'.$str.'"');
        if ($query->num_rows() > 0)
            return FALSE;
        else
            return TRUE;
    }
}
?>
