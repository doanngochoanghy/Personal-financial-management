<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

	public function Get_Expense($year,$month)
	{
		$this->db->flush_cache();
		$this->db->select_sum('money');
		$this->db->select('category_name,icon');
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->where('MONTH(time)', $month);
		$this->db->where('YEAR(time)', $year);
		$this->db->group_by('category.category_id');
		$this->db->join('category', 'category.category_id = expense.category_id', 'left');
		$query=$this->db->get('expense');
		return $query->result_array();
	}
	public function Get_Income($year,$month)
	{
		$this->db->flush_cache();
		$this->db->select_sum('money');
		$this->db->select('category_name,icon');
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->where('MONTH(time)', $month);
		$this->db->where('YEAR(time)', $year);
		$this->db->group_by('category.category_id');
		$this->db->join('category', 'category.category_id = income.category_id', 'left');
		$query=$this->db->get('income');
		return $query->result_array();
		
	}
}

/* End of file Report_model.php */
/* Location: ./application/models/Report_model.php */