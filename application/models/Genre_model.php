<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Genre_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_genres()
	{
		$query = $this->db->get('genre');
		return $query->result_array();
	}

	public function get_genre($id)
	{
		$query = $this->db->get_where('genre', array('id' => $id));
		return $query->row_array();
	}

	public function search_genres($search_term)
	{
		$this->db->like('name', $search_term);
		$query = $this->db->get('genre');
		return $query->result_array();
	}
}
?>
