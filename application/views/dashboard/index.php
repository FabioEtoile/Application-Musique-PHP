<?php $title = "Tableau de Bord"; ?>
<?php $this->load->view('templates/header', ['title' => $title]); ?>

<div class="container mt-5">
	<h1>Bienvenue, <?php echo $user['Pseudo']; ?> !</h1>

	<h2>Mes Playlists</h2>
	<a href="<?php echo site_url('playlists/create'); ?>" class="btn btn-primary mb-3">Créer une nouvelle playlist</a>
	<?php if (!empty($playlists)): ?>
		<ul>
			<?php foreach ($playlists as $playlist): ?>
				<li>
					<a href="<?php echo site_url('playlists/view/' . $playlist['id']); ?>"><?php echo $playlist['name']; ?></a>
					<a href="<?php echo site_url('playlists/delete/' . $playlist['id']); ?>" class="btn btn-danger btn-sm">x</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else: ?>
		<p>Aucune playlist trouvée.</p>
	<?php endif; ?>

	<h2>Changer le mot de passe</h2>
	<form action="<?php echo site_url('dashboard/change_password'); ?>" method="post">
		<div class="form-group">
			<label for="current_password">Mot de passe actuel</label>
			<input type="password" class="form-control" id="current_password" name="current_password" required>
		</div>
		<div class="form-group">
			<label for="new_password">Nouveau mot de passe</label>
			<input type="password" class="form-control" id="new_password" name="new_password" required>
		</div>
		<div class="form-group">
			<label for="confirm_password">Confirmer le nouveau mot de passe</label>
			<input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
		</div>
		<button type="submit" class="btn btn-primary">Changer le mot de passe</button>
	</form>

	<h2>Supprimer le compte</h2>
	<form action="<?php echo site_url('dashboard/delete_account'); ?>" method="post">
		<button type="submit" class="btn btn-danger">Supprimer mon compte</button>
	</form>
</div>

<!-- Modal pour ajouter une chanson à une playlist -->
<div class="modal fade" id="addToPlaylistModal" tabindex="-1" role="dialog" aria-labelledby="addToPlaylistModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addToPlaylistModalLabel">Ajouter à une Playlist</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="add-to-playlist-form" method="post" action="<?php echo site_url('playlists/add_song'); ?>">
					<input type="hidden" id="song-id" name="song_id" value="">
					<div class="form-group">
						<label for="playlist-id">Sélectionner une Playlist</label>
						<select class="form-control" id="playlist-id" name="playlist_id" required>
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
	$(document).ready(function() {
		$('.add-to-playlist').on('click', function() {
			var songId = $(this).data('song-id');
			$('#song-id').val(songId);
			$('#addToPlaylistModal').modal('show');
		});
	});
</script>

<?php $this->load->view('templates/footer'); ?>
