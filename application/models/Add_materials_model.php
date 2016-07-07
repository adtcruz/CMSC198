<?php
/*
* file: AddMaterials_model.php
*   This is the model used in adding materials.
*   The model only contains the database call since they transactins are done using AJAX.
*/
// deny direct access
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class declarations
class Add_materials_model extends CI_Model
{
    // class constructor
    public function __construct ()
    {
        // call to parent constructor
        parent::__construct ();
        // load current database based on database.php
        $this->load->database ();
    }
}
?>
