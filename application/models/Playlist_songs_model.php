<?php
class Playlist_songs_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function add_song_to_playlist($playlist_id, $song_id)
	{
		return $this->db->insert('playlist_songs', array('playlist_id' => $playlist_id, 'song_id' => $song_id));
	}

	public function get_songs_in_playlist($playlist_id)
	{
		$this->db->select('song.*');
		$this->db->from('playlist_songs');
		$this->db->join('song', 'playlist_songs.song_id = song.id');
		$this->db->where('playlist_songs.playlist_id', $playlist_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function remove_song_from_playlist($playlist_id, $song_id)
	{
		$this->db->delete('playlist_songs', array('playlist_id' => $playlist_id, 'song_id' => $song_id));
	}
}
?>
