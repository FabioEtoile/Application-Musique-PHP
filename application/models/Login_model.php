<?php
class Login_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function verify_user($email, $password)
	{
		$this->db->where('Email', $email);
		$query = $this->db->get('login');
		$user = $query->row_array();

		if ($user && password_verify($password, $user['MotDePasse'])) {
			return $user;
		}
		return false;
	}

	public function create_user($data)
	{
		return $this->db->insert('login', $data);
	}

	public function get_user($user_id)
	{
		$this->db->where('iDCompte', $user_id);
		$query = $this->db->get('login');
		return $query->row_array();
	}
}
?>
