<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->model('Playlist_model');
		$this->load->library('session');
		$this->load->model('User_model');
	}

	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->Login_model->get_user($user_id);
		$data['playlists'] = $this->Playlist_model->get_user_playlists($user_id);
		$data['title'] = 'Tableau de bord';

		$this->load->view('dashboard/index', $data);
	}

	public function change_password()
	{
		$user_id = $this->session->userdata('user_id');

		// Vérifier si l'utilisateur est connecté
		if (!$user_id) {
			redirect('login');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('current_password', 'Mot de passe actuel', 'required');
		$this->form_validation->set_rules('new_password', 'Nouveau mot de passe', 'required|min_length[8]');
		$this->form_validation->set_rules('confirm_password', 'Confirmer le nouveau mot de passe', 'required|matches[new_password]');

		if ($this->form_validation->run() === FALSE) {
			$this->index();
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password');

			$user = $this->User_model->get_user($user_id);

			if (password_verify($current_password, $user['MotDePasse'])) {
				$new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
				$this->User_model->update_password($user_id, $new_password_hashed);
				$this->session->set_flashdata('message', 'Mot de passe mis à jour avec succès.');
			} else {
				$this->session->set_flashdata('error', 'Le mot de passe actuel est incorrect.');
			}

			redirect('dashboard');
		}
	}

	public function delete_account()
	{
		$user_id = $this->session->userdata('user_id');

		// Vérifier si l'utilisateur est connecté
		if (!$user_id) {
			redirect('login');
		}

		$this->User_model->delete_user($user_id);
		$this->session->unset_userdata('user_id');
		$this->session->set_flashdata('message', 'Votre compte a été supprimé avec succès.');

		redirect('home');
	}
}
?>
