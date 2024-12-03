<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Song_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_songs()
	{
		$this->db->select('song.*, album.genreId, genre.name AS genre_name, album.artistId, artist.name AS artist_name');
		$this->db->from('song');
		$this->db->join('track', 'song.id = track.songId', 'left');
		$this->db->join('album', 'track.albumId = album.id', 'left');
		$this->db->join('genre', 'album.genreId = genre.id', 'left');
		$this->db->join('artist', 'album.artistId = artist.id', 'left');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_songs_by_album($albumId)
	{
		$this->db->select('song.*');
		$this->db->from('song');
		$this->db->join('track', 'track.songId = song.id');
		$this->db->where('track.albumId', $albumId);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_song($id)
	{
		$this->db->select('song.*, album.genreId, genre.name AS genre_name, album.artistId, artist.name AS artist_name');
		$this->db->from('song');
		$this->db->join('track', 'song.id = track.songId', 'left');
		$this->db->join('album', 'track.albumId = album.id', 'left');
		$this->db->join('genre', 'album.genreId = genre.id', 'left');
		$this->db->join('artist', 'album.artistId = artist.id', 'left');
		$this->db->where('song.id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_songs_by_artist($artist_id)
	{
		$this->db->select('song.*, album.name as album_name, album.id as album_id');
		$this->db->from('song');
		$this->db->join('track', 'track.songId = song.id');
		$this->db->join('album', 'album.id = track.albumId');
		$this->db->where('album.artistId', $artist_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function search_songs($query)
	{
		if (empty($query)) {
			return [];
		}

		$this->db->select('song.*, album.name as album_name, album.id as album_id, artist.name as artist_name, artist.id as artist_id');
		$this->db->from('song');
		$this->db->join('track', 'track.songId = song.id');
		$this->db->join('album', 'album.id = track.albumId');
		$this->db->join('artist', 'artist.id = album.artistId');
		$this->db->like('song.name', $query);
		$result = $this->db->get();
		return $result->result_array();
	}
}
?>
