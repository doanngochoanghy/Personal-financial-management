<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget extends CI_Controller {

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
		$budget_list=$this->budget_model->Get_All_Budget_In_Month($year,$month);
		var_dump($budget_list);
		$data['budget_list']=$budget_list;
		$this->load->view('template/header');
		$this->load->view('Budget/budget',$data);
		$this->load->view('template/footer');
	}

}

/* End of file budget.php */
/* Location: ./application/controllers/budget.php */