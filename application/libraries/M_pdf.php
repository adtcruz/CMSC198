<?php
/*
M_pdf
This class uses the third party PHP library called MPDF. MPDF is used to convert from HTML to PDF. This is a convenience class used in CodeIgniter to easily make use of MPDF.

To use this class, add this line
$this->load->library ('mpdf');
*/

// deny direct access
if (!defined('BASEPATH')) exit('No direct script access allowed');

// include main path of the library
include_once APPPATH.'/third_party/MPDF/mpdf.php';

// class declaration
class M_pdf
{
    public $pdf;
    public function __construct()
    {
        /*
			mPDF (string mode, string format, float default_font_size, string default_font, float margin_left, float margin_right, float margin_top, float margin_bottom, float margin_header, float margin_footer, string orientation);

			refer to the documentation @ mpdf.github.io/reference/mpdf-functions/mpdf.html
        */
        $this->pdf = new mPDF("c", "letter", 12, "Sans-serif", 20, 20, 20, 20, 10, 10, "p");
    }
}
