<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_user($id)
	{
		$this->db->where('iDCompte', $id);
		$query = $this->db->get('login');
		return $query->row_array();
	}

	public function update_user($id, $data)
	{
		$this->db->where('iDCompte', $id);
		return $this->db->update('login', $data);
	}

	public function update_password($id, $new_password)
	{
		$this->db->where('iDCompte', $id);
		return $this->db->update('login', ['MotDePasse' => $new_password]);
	}

	public function delete_user($id)
	{
		$this->session->unset_userdata('logged_in');
		$this->db->where('iDCompte', $id);
		return $this->db->delete('login');
	}
}
?>
