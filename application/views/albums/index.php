<?php $title = $album['name']; ?>
<?php $this->load->view('templates/header', ['title' => $title]); ?>

<div class="container mt-5">
	<h1 class="my-4"><?php echo $album['name']; ?></h1>
	<?php if (!empty($album['cover_image'])): ?>
		<img src="data:image/jpeg;base64,<?php echo base64_encode($album['cover_image']); ?>" class="img-fluid" alt="<?php echo $album['name']; ?>">
	<?php endif; ?>
	<p><strong>Année de sortie:</strong> <?php echo $album['year']; ?></p>
	<p><strong>Genre:</strong> <?php echo $album['genre_name']; ?></p>
	<p><strong>Artiste:</strong>
		<a href="<?php echo site_url('artists/view/' . $album['artistId']); ?>">
			<?php echo $album['artist_name']; ?>
		</a>
	</p>

	<!-- Ajout d'un album a une playlist -->
	<?php if (!empty($playlists)): ?>
		<button class="btn btn-primary mb-3" onclick="showAddAlbumToPlaylistModal()">Ajouter l'album à une playlist</button>
	<?php endif; ?>

	<h2 class="my-4">Liste des Chansons</h2>
	<?php if (!empty($songs)): ?>
		<ul class="list-group">
			<?php foreach ($songs as $song): ?>
				<li class="list-group-item d-flex justify-content-between align-items-center">
					<?php echo $song['name']; ?>
					<?php if (!empty($playlists)): ?>
						<button class="btn btn-sm btn-outline-primary" onclick="showPlaylistModal(<?php echo $song['id']; ?>)">+</button>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else: ?>
		<p>Aucune chanson trouvée pour cet album.</p>
	<?php endif; ?>
</div>

<?php if (!empty($playlists)): ?>
	<!-- Ajouter des sons a une playlist -->
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

	<!-- Ajout d'un album a une playlist -->
	<div class="modal fade" id="addAlbumToPlaylistModal" tabindex="-1" role="dialog" aria-labelledby="addAlbumToPlaylistModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addAlbumToPlaylistModalLabel">Ajouter l'album à une playlist</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="addAlbumToPlaylistForm" method="post" action="<?php echo site_url('playlists/add_album_to_playlist'); ?>">
						<input type="hidden" name="album_id" id="album_id" value="<?php echo $album['id']; ?>">
						<div class="form-group">
							<label for="playlist_id">Sélectionnez une playlist:</label>
							<select class="form-control" id="album_playlist_id" name="playlist_id">
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

		function showAddAlbumToPlaylistModal() {
			$('#addAlbumToPlaylistModal').modal('show');
		}
	</script>
<?php endif; ?>

<?php $this->load->view('templates/footer'); ?>
