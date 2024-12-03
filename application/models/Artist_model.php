<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_artists()
	{
		$query = $this->db->get('artist');
		return $query->result_array();
	}

	public function get_artist($id)
	{
		$query = $this->db->get_where('artist', array('id' => $id));
		return $query->row_array();
	}

	public function search_artists($query)
	{
		if (empty($query)) {
			return [];
		}

		$this->db->like('name', $query);
		$query = $this->db->get('artist');
		return $query->result_array();
	}

	public function get_random_artists($limit)
	{
		$this->db->order_by('id', 'RANDOM');
		$this->db->limit($limit);
		$query = $this->db->get('artist');
		return $query->result_array();
	}

	public function get_artists_sorted($sort, $order)
	{
		if ($sort == 'name') {
			$this->db->order_by('name', $order);
		}

		$query = $this->db->get('artist');
		return $query->result_array();
	}
}
?>
