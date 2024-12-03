<?php $title = "Artiste: " . $artist['name']; ?>
<?php $this->load->view('templates/header', ['title' => $title]); ?>

<div class="container mt-5">
	<h1><?php echo $artist['name']; ?></h1>

	<!-- Button to add all songs of the artist to a playlist -->
	<?php if (!empty($playlists)): ?>
		<button class="btn btn-primary mb-3" onclick="showAddArtistToPlaylistModal()">Ajouter l'artiste à une playlist</button>
	<?php endif; ?>

	<h2>Albums</h2>
	<?php if (!empty($albums)): ?>
		<div class="row">
			<?php foreach ($albums as $album): ?>
				<div class="col-md-4 mb-4">
					<div class="card">
						<?php if (!empty($album['cover_image'])): ?>
							<img src="data:image/jpeg;base64,<?php echo base64_encode($album['cover_image']); ?>" class="card-img-top" alt="<?php echo $album['name']; ?>">
						<?php endif; ?>
						<div class="card-body">
							<h5 class="card-title">
								<a href="<?php echo site_url('albums/view/' . $album['id']); ?>">
									<?php echo $album['name']; ?> (<?php echo $album['year']; ?>)
								</a>
							</h5>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<p>Aucun album trouvé.</p>
	<?php endif; ?>

	<h2>Chansons</h2>
	<?php if (!empty($songs)): ?>
		<ul>
			<?php foreach ($songs as $song): ?>
				<li>
					<?php echo $song['name']; ?>
					<button class="btn btn-sm btn-outline-primary" onclick="showPlaylistModal(<?php echo $song['id']; ?>)">+</button>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else: ?>
		<p>Aucune chanson trouvée.</p>
	<?php endif; ?>
</div>

<?php if (!empty($playlists)): ?>
	<!-- Ajouter à la playlist -->
	<div class="modal fade" id="playlistModal" tabindex="-1" role="dialog" aria-labelledby="playlistModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="playlistModalLabel">Ajouter à une playlist</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="addToPlaylistForm" method="post" action="<?php echo site_url('playlists/add_song'); ?>">
						<input type="hidden" name="song_id" id="song_id">
						<div class="form-group">
							<label for="playlist_id">Sélectionnez une playlist:</label>
							<select class="form-control" id="playlist_id" name="playlist_id">
								<?php foreach ($playlists as $playlist): ?>
									<option value="<?php echo $playlist['id']; ?>"><?php echo $playlist['name']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<button type="submit" class="btn btn-primary">Ajouter</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Ajouter artiste -->
	<div class="modal fade" id="addArtistToPlaylistModal" tabindex="-1" role="dialog" aria-labelledby="addArtistToPlaylistModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addArtistToPlaylistModalLabel">Ajouter l'artiste à une playlist</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="addArtistToPlaylistForm" method="post" action="<?php echo site_url('playlists/add_artist_to_playlist'); ?>">
						<input type="hidden" name="artist_id" id="artist_id" value="<?php echo $artist['id']; ?>">
						<div class="form-group">
							<label for="artist_playlist_id">Sélectionnez une playlist:</label>
							<select class="form-control" id="artist_playlist_id" name="playlist_id">
								<?php foreach ($playlists as $playlist): ?>
									<option value="<?php echo $playlist['id']; ?>"><?php echo htmlspecialchars($playlist['name'], ENT_QUOTES, 'UTF-8'); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<button type="submit" class="btn btn-primary">Ajouter</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		function showPlaylistModal(songId) {
			document.getElementById('song_id').value = songId;
			$('#playlistModal').modal('show');
		}

		function showAddArtistToPlaylistModal() {
			$('#addArtistToPlaylistModal').modal('show');
		}
	</script>
<?php endif; ?>

<?php $this->load->view('templates/footer'); ?>
