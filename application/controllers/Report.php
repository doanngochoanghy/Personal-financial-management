<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function index()
	{
		if (empty($this->input->post("month"))) {
			$month=date("m");
			$year=date("Y");
		}
		else
		{
			$time=$this->input->post("month");
			$time=DateTime::createFromFormat('m-Y', $time);
			$month=date_format($time,"m");
			$year=date_format($time,"Y");
		}
		$data['month_select']=$month;
		$data['year_select']=$year;
		$data_expense=$this->report_model->Get_Expense($year,$month);
		$data['data_expense']=$data_expense;
		$data_income=$this->report_model->Get_Income($year,$month);
		$data['data_income']=$data_income;
		$this->load->view('template/header');
		$this->load->view('Report/report',$data);
		$this->load->view('template/footer');
	}

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */