<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Songs extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Song_model');
	}

	//public function index()
	//{
	//	$data['songs'] = $this->Song_model->get_songs();
	//	$this->load->view('songs/index', $data);
	//}

	public function view($id)
	{
		$data['song'] = $this->Song_model->get_song($id);
		$this->load->view('songs/view', $data);
	}
}
?>
