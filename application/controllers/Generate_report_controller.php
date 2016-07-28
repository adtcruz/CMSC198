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
        $this->load->model ('Notifications_model', 'nm');
        // loads form validation library
		$this->load->library ('form_validation');
        $this->load->model ('Chart_model', 'cm');
		session_start ();
	}

    public function index ()
    {
        if ( array_key_exists ("type", $_SESSION))
        {
            if ($_SESSION['type'] === 'superadmin')
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
                    $db_data['unread'] = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
                    $this->load->view ('Generate_report_view', $db_data);
                }
                // else publish PDF report
                else
                {
                    $db_data['unread'] = $this->nm->getUnreadCount ($_SESSION['username'], $_SESSION['type']);
                    $db_data['income'] = $this->cm->getMonthlyIncome ();
                    $this->reportToPDF ($db_data);
                }
            }
        }
        else
        {
            redirect (base_url (), 'refresh');
        }
	}

    // this function renders a page to PDF form. it gets all the job requests created between the two dates sent via post
	public function reportToPDF ($db_data)
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

        //$this->load->view ('Generate_report_reportPDF');
        $html = $this->load->view ('Generate_report_reportPDF', $db_data, TRUE);
		$this->load->library ('m_pdf');
		$pdfFileName = 'Activity Report from '.$date['date1'].' to '.$date['date2'];
		$this->m_pdf->pdf->WriteHTML ($html);
		$this->m_pdf->pdf->Output ();
	}
}
// end of GenerateReport_controller.php
?>
