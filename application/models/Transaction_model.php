<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {

	public function Get_all_date($year,$month)
	{
		$this->db->flush_cache();
		$this->db->select('time');
		$this->db->from('expense');
		$this->db->where('MONTH(time)', $month);
		$this->db->where('YEAR(time)', $year);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$query1 = $this->db->get_compiled_select();
		$this->db->flush_cache();
		$this->db->select('time');
		$this->db->from('income');
		$this->db->where('MONTH(time)', $month);
		$this->db->where('YEAR(time)', $year);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$query2 = $this->db->get_compiled_select();
		$this->db->flush_cache();
		$query = $this->db->query($query1 . ' UNION ' . $query2.'ORDER BY time desc');
		return $query->result_array();
	}
	public function Get_all_expense($time)
	{
		$this->db->flush_cache();
		$this->db->join('category', 'expense.category_id = category.category_id', 'left');
		$query = $this->db->get_where('expense', array('time' => $time,'user_id'=>$this->session->userdata('user_id')));
		return $query->result_array();
	}
	public function Get_all_income($time)
	{
		$this->db->flush_cache();
		$this->db->join('category', 'income.category_id = category.category_id', 'left');
		$query = $this->db->get_where('income', array('time' => $time,'user_id'=>$this->session->userdata('user_id')));
		return $query->result_array();
	}
	public function Add_transaction($data)
	{
		//Lấy số tiền trong ví hiện tại của user
		$money=$this->GetMoney($data['user_id']);//Số tiền hiện tại
		$this->db->flush_cache();
		if ($data['category_id']<15) {
			$this->db->insert('expense', $data);
			$money-=$data['money'];//Chi tiêu trừ đi số tiền
		} else {
			$this->db->insert('income', $data);
			$money+=$data['money'];//thu Nhập tăng số tiền
		}
		$this->UpdateWallet($data['user_id'],$money); //Cập nhật số tiền
	}
	public function GetMoney($user_id)
	{
		$this->db->flush_cache();
		$this->db->select('wallet');
		$money=$this->db->get_where('users', array('user_id'=>$user_id));
		$money=$money->result_array();
		$money=$money[0];
		return (int)$money['wallet'];
	}
	public function UpdateWallet($user_id,$wallet)
	{
		$this->db->flush_cache();
		$this->db->where('user_id', $user_id);
		$this->db->update('users', array('wallet'=>$wallet));
	}
	public function Get_Expense($expense_id)
	{
		$this->db->flush_cache();
		$this->db->where('expense_id', $expense_id);
		$this->db->join('category', 'category.category_id = expense.category_id', 'left');
		$transaction=$this->db->get('expense');
		$transaction=$transaction->result_array();
		if ($transaction!=NULL) {
			return $transaction[0];
		}
		
	}
	public function Get_Income($income_id)
	{
		$this->db->flush_cache();
		$this->db->where('income_id', $income_id);
		$this->db->join('category', 'category.category_id = income.category_id', 'left');
		$transaction=$this->db->get('income');
		return $transaction->result_array()[0];
	}
	public function UpdateTransaction($data)
	{
		$this->db->flush_cache();
		$wallet=$this->GetMoney($data['user_id']);
		if ($data['category_id']<15) {
			$this->db->flush_cache();
			$old_money=$this->Get_Expense($data['transaction_id']);
			$new_money=$data['money'];
			$wallet=$wallet-(int)$new_money+(int)$old_money['money'];
			// echo($old_money);
			$this->UpdateWallet($data['user_id'],$wallet);
			$this->db->flush_cache();
			$this->db->where('expense_id', $data['transaction_id']);
			$this->db->update('expense', array('category_id' => $data['category_id'],
			'money'=>$data['money'],'time'=>$data['time'],'note'=>$data['note']));
		}
		else{
			$this->db->flush_cache();
			$old_money=$this->Get_Income($data['transaction_id']);
			$new_money=$data['money'];
			$wallet=$wallet+(int)$new_money-(int)$old_money['money'];
			$this->UpdateWallet($data['user_id'],$wallet);
			$this->db->flush_cache();
			$this->db->where('income_id', $data['transaction_id']);
			$this->db->update('income', array('category_id' => $data['category_id'],
			'money'=>$data['money'],'time'=>$data['time'],'note'=>$data['note']));
		}
	}
	public function Delete_Expense($expense_id)
	{
		$this->db->flush_cache();
		$this->db->where('expense_id', $expense_id);
		$this->db->delete('expense');
	}
	public function Delete_Income($income_id)
	{
		$this->db->flush_cache();
		$this->db->where('income_id', $income_id);
		$this->db->delete('income');
	}
}

/* End of file Transaction_model.php */
/* Location: ./application/models/Transaction_model.php */