<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('user_id')) {
			redirect('dashboard');
		}
		$this->load->view('register/index');
	}

	public function create_account()
	{
		$this->form_validation->set_rules('pseudo', 'Pseudo', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[login.Email]');
		$this->form_validation->set_rules('password', 'Mot de passe', 'required|min_length[6]');

		if ($this->form_validation->run() === FALSE) {
			log_message('debug', 'Form validation failed: ' . validation_errors());
			$this->load->view('register/index');
		} else {
			$data = array(
				'Pseudo' => $this->input->post('pseudo'),
				'Email' => $this->input->post('email'),
				'MotDePasse' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
			);

			log_message('debug', 'User data: ' . print_r($data, TRUE));

			if ($this->Login_model->create_user($data)) {
				log_message('debug', 'SQL Query: ' . $this->db->last_query());
				$data['success'] = 'Votre compte a été créé avec succès ! Vous pouvez maintenant vous connecter.';
				$this->load->view('register/index', $data);
			} else {
				$db_error = $this->db->error();
				log_message('error', 'Database error: ' . print_r($db_error, TRUE));
				$data['error'] = 'Une erreur s\'est produite lors de la création de votre compte. Veuillez réessayer.';
				$this->load->view('register/index', $data);
			}
		}
	}
}
?>
