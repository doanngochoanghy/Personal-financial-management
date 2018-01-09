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
				echo "string";
				$this->load->view('template/footer');
			} else {
				$username=htmlspecialchars($this->input->post('username'),ENT_QUOTES);
				$password=md5($this->input->post('password'));
				echo($username);
				echo $password;

				$user_data=$this->users_model->login($username,$password);
				//var_dump($user_data);
				if ($user_data!=FALSE) {
					$user_data=(array)$user_data;
					$user_data["loggedin"] = true;
					$this->session->set_userdata($user_data);
					$this->session->set_flashdata('message', 'Welcome '.$this->session->userdata('username').'. You are logged in.');
					redirect(base_url(),'');
				} else {
					$this->session->set_flashdata('message', 'Login is invalid.');
					echo($this->session->flashdata('message'));
					redirect(base_url());
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
			// $this->load->view('users/register');
			$this->load->view('template/footer');
		} else {
			$data = array('username' => htmlspecialchars($this->input->post('username'),ENT_QUOTES),'password' => md5($this->input->post('password')),
				);
			$this->users_model->register($data);
			$this->session->set_flashdata('message', 'You are registered. You can login');
			redirect(base_url()."Users/Login",'');
		}
	}
}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */