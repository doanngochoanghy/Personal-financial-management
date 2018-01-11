<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('loggedin')) {
			$user_data=$this->users_model->GetUser($this->session->userdata('user_id'));
			$user_data=array($user_data);
			$this->session->set_userdata( $user_data[0]);
			// var_dump($this->session->userdata());
			redirect(base_url().'Transaction','');
		}
		else{
			redirect(base_url().'Users/Login');
		}
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */