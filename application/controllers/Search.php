<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Artist_model');
		$this->load->model('Album_model');
		$this->load->model('Song_model');
		$this->load->model('Playlist_model');
		$this->load->library('session');
	}

	public function index()
	{
		$query = $this->input->get('q', TRUE);

		if ($query === NULL) {
			$query = '';
		}

		if (empty($query)) {
			$data['artists'] = [];
			$data['albums'] = [];
			$data['songs'] = [];
			$data['query'] = $query;

			if ($this->session->userdata('logged_in')) {
				$user_id = $this->session->userdata('user_id');
				$data['playlists'] = $this->Playlist_model->get_user_playlists($user_id);
			} else {
				$data['playlists'] = [];
			}


			$this->load->view('search/results', $data);
			return;
		}

		$data['artists'] = $this->Artist_model->search_artists($query);
		$data['albums'] = $this->Album_model->search_albums($query);
		$data['songs'] = $this->Song_model->search_songs($query);

		$data['query'] = $query;

		if ($this->session->userdata('logged_in')) {
			$user_id = $this->session->userdata('user_id');
			$data['playlists'] = $this->Playlist_model->get_user_playlists($user_id);
		} else {
			$data['playlists'] = [];
		}


		$this->load->view('search/results', $data);
	}

	public function results()
	{
		$query = $this->input->get('q');

		$data['title'] = 'Résultats de recherche pour "' . htmlspecialchars($query) . '"';
		$data['albums'] = $this->Album_model->search_albums($query);
		$data['artists'] = $this->Artist_model->search_artists($query);
		$data['songs'] = $this->Song_model->search_songs($query);
		$data['query'] = $query;

		if ($this->session->userdata('logged_in')) {
			$user_id = $this->session->userdata('user_id');
			$data['playlists'] = $this->Playlist_model->get_user_playlists($user_id);
		} else {
			$data['playlists'] = [];
		}


		$this->load->view('search/results', $data);
	}
}
?>
