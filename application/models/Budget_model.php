<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget_model extends CI_Model {

	public function Get_All_Budget_In_Month($year,$month)
	{
		$this->db->flush_cache();
		$this->db->where('Month(time)', $month);
		$this->db->where('YEAR(time)', $year);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->join('category', 'category.category_id = budget.category_id', 'left');
		$query=$this->db->get('budget');
		return $query->result_array();
	}
	public function Get_Sum_Money_By_id($year,$month,$category_id)
	{
		$this->db->flush_cache();
		$this->db->select_sum('money');
		$this->db->where('Month(time)', $month);
		$this->db->where('YEAR(time)', $year);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->where('category_id', $category_id);
		$query=$this->db->get('expense');
		return (int)$query->result_array()[0]['money'];
	}
	public function Get_Budget_By_id($budget_id)
	{
		$this->db->flush_cache();
		$this->db->where('budget_id', $budget_id);
		$query=$this->db->get('budget');
		return $query->row_array();
	}
	public function Delete($user_id,$budget_id)
	{
		$this->db->flush_cache();
		$this->db->where('budget_id', $budget_id);
		$this->db->where('user_id', $user_id);
		$this->db->delete('budget');
	}
	public function Change($budget)
	{
		$this->db->flush_cache();
		$this->db->where('budget_id', $budget['budget_id']);
		$this->db->where('user_id', $budget['user_id']);
		$this->db->update('budget', array('budget_money' => $budget['budget_money'],'time' => $budget['time'],'note' => $budget['note'],'category_id' => $budget['category_id'] ));
	}
	public function Add($budget)
	{
		$this->db->flush_cache();
		$this->db->insert('budget', $budget);
	}
}

/* End of file budget_model.php */
/* Location: ./application/models/budget_model.php */