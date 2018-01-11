<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

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
		$this->ViewDateOfMonth($year,$month);
	}
	//Danh sách những ngày có giao dịch.
	public function ViewDateOfMonth($year,$month)
	{
		$dates=$this->transaction_model->Get_all_date($year,$month);
		$data=array('dates'=>$dates);
		$month_select=$month;
		$year_select=$year;
		$data['month_select']=$month_select;
		$data['year_select']=$year_select;
		$this->load->view('template/header');
		$this->load->view('Transaction/ListTransaction', $data);
		$this->load->view('template/footer');
	}

	//Thêm giao dịch mới 
	public function AddTransaction()
	{
		$user_id=$this->input->post('user_id');
		if ($user_id==$this->session->userdata('user_id')) {
			$this->transaction_model->Add_Transaction($this->input->post());
		}
		$this->session->set_flashdata('message', 'The transaction has added successful!');
		redirect(base_url()."Transaction");
	}
	public function View($type,$transaction_id)
	{
		if($type=="expense"){
			$data_transaction=$this->transaction_model->Get_Expense($transaction_id);
			$data_transaction['type']="expense";
		}
		elseif ($type=="income") {
			$data_transaction=$this->transaction_model->Get_Income($transaction_id);
			$data_transaction['type']="income";
		}
		if ($data_transaction!=NULL) {
			if ($data_transaction['user_id']==$this->session->userdata('user_id')) {
				// var_dump($data_transaction);
				$data = array('data_transaction' => $data_transaction);
				$this->load->view('template/header');
				$this->load->view('Transaction/View',$data);
				$this->load->view('template/footer');
			}
			else{
				redirect(base_url());
			}
		}
		else{
				redirect(base_url());
		}
	}
	public function UpdateTransaction()
	{
		$data_transaction=$this->input->post();
		var_dump($data_transaction);
		if (!empty($data_transaction)) {
			if ($data_transaction['user_id']==$this->session->userdata('user_id')) 
			{
				$this->transaction_model->UpdateTransaction($data_transaction);
			}
			$this->session->set_flashdata('message', 'The transaction has changed!');
			redirect(base_url().'Transaction');
		}
	}
	public function Delete()
	{
		var_dump($this->input->post());
		if ($this->input->post('user_id')==$this->session->userdata('user_id')) {
			$wallet=$this->transaction_model->GetMoney($this->session->userdata('user_id'));
			$money=$this->input->post('money');
			if ($this->input->post('category_id')<15) {
				$this->transaction_model->Delete_Expense($this->input->post('transaction_id'));
				$wallet=$wallet+$money;
			} else {
				$this->transaction_model->Delete_Income($this->input->post('transaction_id'));
				$wallet=$wallet-$money;
			}
			$this->transaction_model->UpdateWallet($this->input->post('user_id'),$wallet)	;
			// $this->transaction_model->UpdateWallet($user_id,$money);
			$this->session->set_flashdata('message', 'Deleted the transaction!');
		}
		redirect(base_url()."Transaction");
	}
}

/* End of file Transaction.php */
/* Location: ./application/controllers/Transaction.php */