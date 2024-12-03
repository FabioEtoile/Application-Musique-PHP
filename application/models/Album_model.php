<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Album_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_albums($sort_by = 'name', $order = 'asc')
	{
		$this->db->select('album.*, artist.name as artist_name, genre.name as genre_name');
		$this->db->from('album');
		$this->db->join('artist', 'album.artistId = artist.id');
		$this->db->join('genre', 'album.genreId = genre.id');

		if (in_array($sort_by, ['name', 'year', 'genre_name', 'artist_name']) && in_array($order, ['asc', 'desc'])) {
			$this->db->order_by($sort_by, $order);
		}

		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_album($id)
	{
		$this->db->select('album.*, artist.name as artist_name, genre.name as genre_name, cover.jpeg as cover_image');
		$this->db->from('album');
		$this->db->join('artist', 'album.artistId = artist.id');
		$this->db->join('genre', 'album.genreId = genre.id');
		$this->db->join('cover', 'album.coverId = cover.id', 'left');
		$this->db->where('album.id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}


	public function get_albums_by_artist($artist_id)
	{
		$this->db->select('album.*, cover.jpeg as cover_image');
		$this->db->from('album');
		$this->db->join('cover', 'cover.id = album.coverId', 'left');
		$this->db->where('album.artistId', $artist_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function search_albums($query)
	{
		if (empty($query)) {
			return [];
		}

		$this->db->select('album.*, cover.jpeg as cover_image, artist.name as artist_name');
		$this->db->from('album');
		$this->db->join('artist', 'artist.id = album.artistId', 'left');
		$this->db->join('cover', 'cover.id = album.coverId', 'left');
		$this->db->like('album.name', $query);
		$result = $this->db->get();
		return $result->result_array();
	}

	public function search_genres($search_term)
	{
		// Recherche des albums par genre
		$this->db->select('album.*, artist.name as artist_name, genre.name as genre_name, cover.jpeg as cover_image');
		$this->db->from('album');
		$this->db->join('artist', 'album.artistId = artist.id', 'left');
		$this->db->join('genre', 'album.genreId = genre.id', 'left');
		$this->db->join('cover', 'album.coverId = cover.id', 'left');
		$this->db->like('genre.name', $search_term);
		$query = $this->db->get();
		$albums = $query->result_array();

		// Recherche des chansons par genre
		$this->db->select('song.*, album.genreId, genre.name AS genre_name, album.artistId, artist.name AS artist_name');
		$this->db->from('song');
		$this->db->join('track', 'song.id = track.songId', 'left');
		$this->db->join('album', 'track.albumId = album.id', 'left');
		$this->db->join('genre', 'album.genreId = genre.id', 'left');
		$this->db->join('artist', 'album.artistId = artist.id', 'left');
		$this->db->like('genre.name', $search_term);
		$query = $this->db->get();
		$songs = $query->result_array();

		return ['albums' => $albums, 'songs' => $songs];
	}

	public function get_random_albums_with_covers($limit)
	{
		$this->db->select('album.*, artist.name as artist_name, genre.name as genre_name, cover.jpeg as cover_image');
		$this->db->from('album');
		$this->db->join('artist', 'album.artistId = artist.id', 'left');
		$this->db->join('genre', 'album.genreId = genre.id', 'left');
		$this->db->join('cover', 'album.coverId = cover.id', 'left');
		$this->db->order_by('album.id', 'RANDOM');
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_albums_sorted($sort = null, $order = 'ASC', $genres = [])
	{
		$this->db->select('album.*, artist.name as artist_name, genre.name as genre_name, cover.jpeg as cover_image');
		$this->db->from('album');
		$this->db->join('artist', 'album.artistId = artist.id');
		$this->db->join('genre', 'album.genreId = genre.id', 'left');
		$this->db->join('cover', 'album.coverId = cover.id', 'left');

		if (!empty($genres)) {
			$this->db->where_in('album.genreId', $genres);
		}

		if ($sort) {
			$this->db->order_by($sort, $order);
		}

		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_albums_by_genres($genres, $sort_by = 'name', $order = 'asc')
	{
		$this->db->select('album.*, artist.name as artist_name, genre.name as genre_name, cover.jpeg as cover_image');
		$this->db->from('album');
		$this->db->join('artist', 'album.artistId = artist.id');
		$this->db->join('genre', 'album.genreId = genre.id');
		$this->db->join('cover', 'album.coverId = cover.id', 'left');

		if (!empty($genres)) {
			$this->db->where_in('album.genreId', $genres);
		}

		if (in_array($sort_by, ['name', 'year', 'genre_name', 'artist_name']) && in_array($order, ['asc', 'desc'])) {
			$this->db->order_by($sort_by, $order);
		}

		$query = $this->db->get();
		return $query->result_array();
	}
}
?>
