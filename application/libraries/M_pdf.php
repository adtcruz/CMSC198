<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
 include_once APPPATH.'/third_party/MPDF/mpdf.php';
 
class M_pdf {
 
    public $param;
    public $pdf;
 
    public function __construct()
    {
        $this->pdf = new mPDF("c");
    }
}