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
		// var_dump($budget_list);
		$data['budget_list']=$budget_list;
		$this->load->view('template/header');
		$this->load->view('Budget/budget',$data);
		$this->load->view('template/footer');
	}
	public function View($budget_id)
	{
		$budget=$this->budget_model->Get_Budget_By_id($budget_id);
		$data = array('budget' => $budget);
		$this->load->view('template/header');
		$this->load->view('Budget/View',$data);
		$this->load->view('template/footer');
	}
	public function Delete()
	{
		var_dump($this->input->post());
		if ($this->input->post('user_id')==$this->session->userdata('user_id')) {
			$this->budget_model->Delete($this->session->userdata('user_id'),$this->input->post('budget_id'));
		}
		$this->session->set_flashdata('message', 'Deleted the budget!');
		redirect(base_url()."Budget");
	}
	public function Change()
	{
		var_dump($this->input->post());
		if ($this->input->post('user_id')==$this->session->userdata('user_id')) {
			$budget['user_id']=$this->input->post('user_id');
			$budget['category_id']=$this->input->post('category_id');
			$budget['budget_id']=$this->input->post('budget_id');
			$budget['budget_money']=$this->input->post('budget_money');
			$time = DateTime::createFromFormat('d-m-Y', "01-".$this->input->post('time'));
			$budget['time']=$time->format('Y-m-d');
			$budget['note']=$this->input->post('note');
			$this->budget_model->Change($budget);
			$this->session->set_flashdata('message', 'Updated the budget!');	
		}
		redirect(base_url()."Budget");
	}
	public function Add()
	{
		var_dump($this->input->post());
		$data_budget=$this->input->post();
		$data_budget['note']=htmlspecialchars($data_budget['note'],ENT_QUOTES);
		$data_budget['time']=$data_budget['time']."-01";
		$this->budget_model->Add($data_budget);
		$this->session->set_flashdata('message', 'Add budget successful!');
		redirect(base_url()."Budget");
	}
}

/* End of file budget.php */
/* Location: ./application/controllers/budget.php */