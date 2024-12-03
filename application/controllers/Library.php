<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Playlist_model');
		$this->load->model('Playlist_songs_model');
		$this->load->model('Song_model');
		$this->load->library('session');
	}

	public function view($id)
	{
		$user_id = $this->session->userdata('user_id');
		$data['playlists'] = $this->Playlist_model->get_playlists_by_user($user_id);
		$data['playlist'] = $this->Playlist_model->get_playlist($id);
		$data['songs'] = $this->Playlist_model->get_playlist_songs($id);
		$data['title'] = 'Détails de la Playlist';
		$data['user_playlists'] = $this->Playlist_model->get_playlists_by_user($this->session->userdata('user_id'));

		$this->load->view('playlists/view', $data);
	}

	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		$user_id = $this->session->userdata('user_id');
		$data['playlists'] = $this->Playlist_model->get_playlists_by_user($user_id);

		$this->load->view('library/index', $data);
	}

	public function view_playlist($id)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		$data['playlist'] = $this->Playlist_model->get_playlist($id);
		$data['songs'] = $this->Playlist_model->get_playlist_songs($id);

		$this->load->view('templates/header', ['title' => 'Détails de la Playlist']);
		$this->load->view('library/view_playlist', $data);
	}


	public function create_playlist()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		$this->form_validation->set_rules('name', 'Nom de la Playlist', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->index();
		} else {
			$user_id = $this->session->userdata('user_id');
			$this->Playlist_model->create_playlist($user_id, $this->input->post('name'));
			redirect('library');
		}
	}

	public function delete_playlist($playlist_id)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		$this->Playlist_model->delete_playlist($playlist_id);
		redirect('library');
	}

	public function add_song_to_playlist($playlist_id, $song_id)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		$this->Playlist_model->add_song_to_playlist($playlist_id, $song_id);
		redirect('library/view_playlist/' . $playlist_id);
	}



	public function remove_song_from_playlist($playlist_id, $song_id)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		$this->Playlist_model->remove_song_from_playlist($playlist_id, $song_id);
		redirect('library/view_playlist/' . $playlist_id);
	}
}
?>
