<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function index()
	{
		if ($this->session->userdata('loggedin')) {
			redirect(base_url(),'')	;
		}
		else{
			redirect(base_url().'Users/Login');
		}
	}
	public function Login()
	{
		if ($this->session->userdata('loggedin')) {
			redirect(base_url(),'')	;
		}
		else
		{
			$this->form_validation->set_rules('username', 'Name', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('template/header');
				$this->load->view('Users/Login');
				$this->load->view('template/footer');
			} else {
				$username=htmlspecialchars($this->input->post('username'),ENT_QUOTES);
				$password=md5($this->input->post('password'));
				$user_data=$this->users_model->login($username,$password);
				//var_dump($user_data);
				if ($user_data!=FALSE) {
					$user_data=(array)$user_data;
					$user_data["loggedin"] = true;
					echo($user_data);
					$this->session->set_userdata($user_data);
					$this->session->set_flashdata('message', 'Welcome '.$this->session->userdata('username').'. You are logged in.');
					redirect(base_url(),'');
				} else {
					$this->session->set_flashdata('message', 'Login is invalid.');
					//echo($this->session->flashdata('message'));
					redirect(base_url()."Users/Login");
				}
			}
		}
	}
	public function Logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(),'');
	}
	public function Register()
	{
		//Kiểm tra dữ liệu nhập vào.
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]',array('is_unique'=>'Username already exist'));
		$this->form_validation->set_rules('password', 'Password','required');
		$this->form_validation->set_rules('password_confirmation', 'Password Confirm', 'matches[password]');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header');
			$this->load->view('Users/Login');
			$this->load->view('template/footer');
		} else {
			$data = array('username' => htmlspecialchars($this->input->post('username'),ENT_QUOTES),'password' => md5($this->input->post('password')),
				);
			$this->users_model->register($data);
			$this->session->set_flashdata('message', 'You are registered. You can login');
			redirect(base_url()."Users/Login",'');
		}
	}
	public function ChangeWallet()
	{
		$this->form_validation->set_rules('wallet', 'Wallet','required|integer');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message',validation_errors());
			redirect(base_url());
		} else {
			$this->users_model->ChangeWallet($this->session->userdata('user_id'),$this->input->post('wallet'));
			redirect(base_url());
		}
	}
	public function ChangePassword()
	{
		$this->form_validation->set_rules('new_password', 'Password','required');
		$this->form_validation->set_rules('new_password_confirm', 'Password Confirm', 'matches[new_password]');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header');
			// $this->load->view('Users/Login');
			$this->load->view('template/footer');
			// redirect(base_url()."Transaction");
		} else {
			$username=$this->session->userdata('username');
			$old_password=md5($this->input->post('old_password'));
			$new_password=md5($this->input->post('new_password'));
			$check=$this->users_model->login($username,$old_password);
			// var_dump($check);
			if ($check!=FALSE) {
				$this->users_model->ChangePassword($username,$new_password);
			$this->session->set_flashdata('message', 'Your password was changed!');
		}
			redirect(base_url()."Transaction");
			// $data = array('username' => htmlspecialchars($this->input->post('username'),ENT_QUOTES),'password' => md5($this->input->post('password')),
			// 	);
			// $this->users_model->register($data);
			// $this->session->set_flashdata('message', 'You are registered. You can login');
			// redirect(base_url()."Users/Login",'');
		}
	}
}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */