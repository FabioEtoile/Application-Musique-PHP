<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('login/index');
	}

	public function authenticate()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->Login_model->verify_user($email, $password);

		if ($user) {
			$this->session->set_userdata([
				'user_id' => $user['iDCompte'],
				'username' => $user['Pseudo'],
				'logged_in' => TRUE
			]);

			$redirect_url = $this->session->userdata('redirect_url') ?? 'dashboard';
			$this->session->unset_userdata('redirect_url');
			redirect($redirect_url);
		} else {
			$this->session->set_flashdata('error', 'Identifiants incorrects.');
			redirect('login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
?>
