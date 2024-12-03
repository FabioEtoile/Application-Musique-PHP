<div class="container mt-5">
	<h1>Détails de la Playlist</h1>

	<h2><?php echo $playlist['name']; ?></h2>
	<a href="<?php echo site_url('playlists/duplicate/' . $playlist['id']); ?>" class="btn btn-secondary">Dupliquer la Playlist</a>
	<h3>Chansons</h3>
	<?php if (!empty($songs)): ?>
		<ul>
			<?php foreach ($songs as $song): ?>
				<li>
					<?php echo $song['name']; ?> - Artiste: <?php echo $song['artist_name']; ?>
					<a href="<?php echo site_url('playlists/remove_song/' . $playlist['id'] . '/' . $song['id']); ?>" class="btn btn-danger btn-sm">x</a>
					<button class="btn btn-secondary btn-sm" onclick="showAddToPlaylistPopup(<?php echo $song['id']; ?>)">+</button>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else: ?>
		<p>Aucune chanson trouvée.</p>
	<?php endif; ?>

	<!-- Formulaire pour ajouter des chansons aléatoires -->
	<form action="<?php echo site_url('playlists/add_random_songs/' . $playlist['id']); ?>" method="post">
		<div class="form-group">
			<label for="song_count">Nombre de chansons à ajouter:</label>
			<input type="number" class="form-control" id="song_count" name="song_count" min="1" required>
		</div>
		<button type="submit" class="btn btn-primary">Ajouter des chansons aléatoires</button>
	</form>
</div>

<!-- Popup Modal -->
<div id="addToPlaylistPopup" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter à une playlist</h5>
				<button type="button" class="close" onclick="closeAddToPlaylistPopup()" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="addToPlaylistForm" method="post" action="">
					<input type="hidden" id="song_id" name="song_id" value="">
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

<script>
	function showAddToPlaylistPopup(songId) {
		document.getElementById('song_id').value = songId;
		document.getElementById('addToPlaylistForm').action = '<?php echo site_url('playlists/add_song'); ?>';
		$('#addToPlaylistPopup').modal('show');
	}

	function closeAddToPlaylistPopup() {
		$('#addToPlaylistPopup').modal('hide');
	}
</script>

<?php $this->load->view('templates/footer'); ?>
