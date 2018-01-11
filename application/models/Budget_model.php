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
}

/* End of file budget_model.php */
/* Location: ./application/models/budget_model.php */