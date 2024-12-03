<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artists extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Artist_model');
		$this->load->model('Album_model');
		$this->load->model('Song_model');
		$this->load->model('Playlist_model'); // Ajouter le modèle des playlists
		$this->load->library('session');
	}

	public function view($id)
	{
		$data['artist'] = $this->Artist_model->get_artist($id);
		$data['albums'] = $this->Album_model->get_albums_by_artist($id);
		$data['songs'] = $this->Song_model->get_songs_by_artist($id);

		if ($this->session->userdata('logged_in')) {
			$user_id = $this->session->userdata('user_id');
			$data['playlists'] = $this->Playlist_model->get_user_playlists($user_id); // Charger les playlists de l'utilisateur
		} else {
			$data['playlists'] = [];
		}

		$this->load->view('artists/index', $data); // Utiliser 'index' au lieu de 'view'
	}


	public function list()
	{
		$sort = $this->input->get('sort');
		$order = $this->input->get('order') ?: 'ASC';
		$data['artists'] = $this->Artist_model->get_artists_sorted($sort, $order);
		$this->load->view('artists/list', $data);
	}
}
?>
