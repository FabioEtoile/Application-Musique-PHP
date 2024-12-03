<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Artist_model');
		$this->load->model('Album_model');
	}

	public function index()
	{
		$data['artists'] = $this->Artist_model->get_random_artists(6);
		$data['albums'] = $this->Album_model->get_random_albums_with_covers(6);
		$data['title'] = 'Accueil';
		$this->load->view('home', $data);
	}
}
?>
