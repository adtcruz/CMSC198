<?php
/*
* file: GenerateReport_controller.php
* This is the main controller for the generate report module.
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate_report_controller extends CI_Controller
{
	public function __construct ()
	{
        // constructor
        parent::__construct ();
        // loads model
		$this->load->model ('Generate_report_model', 'grm', TRUE);
        // loads form validation library
		$this->load->library ('form_validation');
		session_start ();
	}

    public function index ()
    {
        if ($_SESSION['type'] != 'client' && array_key_exists ("username", $_SESSION))
        {
            // gets the values from GenerateReport_view_form.php sent via post
            $date_1 = $this->input->post ('date1');
            $date_2 = $this->input->post ('date2');

            // sets form validation rules
            $this->form_validation->set_rules ('date1', 'Date 1', 'required|trim');
            $this->form_validation->set_rules ('date2', 'Date 2', 'required|trim');

            // if the form validation is not run or returns false, reload view.
            if ($this->form_validation->run () == FALSE)
            {
                $this->load->view ('Generate_report_view');
            }
            // else publish PDF report
            else
            {
                $this->reportToPDF ();
            }
        }
	}

    // this function renders a page to PDF form. it gets all the job requests created between the two dates sent via post
	public function reportToPDF ()
	{
		$date1 = $this->input->post ('date1');
		$date2 = $this->input->post ('date2');
		$interval = date_diff (date_create ($date1), date_create ($date2));
		$interval = $interval->format ('%R%a');
		if ($interval > 0)
		{
			$date['date1'] = $date1;
			$date['date2'] = $date2;
		}
		else
		{
			$date['date1'] = $date2;
			$date['date2'] = $date1;
		}
		$db_data = $this->grm->generateReport ($date);
		$html = $this->load->view ('GenerateReport_reportPDF', $db_data, TRUE);
		$this->load->library ('m_pdf');
		$pdfFileName = 'Activity Report from '.$date['date1'].' to '.$date['date2'];
		$this->m_pdf->pdf->WriteHTML ($html);
		$this->m_pdf->pdf->Output ();
	}
}
// end of GenerateReport_controller.php
?>
