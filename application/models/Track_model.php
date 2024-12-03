<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_tracks()
	{
		$query = $this->db->get('track');
		return $query->result_array();
	}

	public function get_track($id)
	{
		$query = $this->db->get_where('track', array('id' => $id));
		return $query->row_array();
	}
}
?>
