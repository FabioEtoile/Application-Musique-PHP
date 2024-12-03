<?php $this->load->view('templates/header', ['title' => 'Créer une Playlist']); ?>

<div class="container mt-5">
	<h1>Créer une Playlist</h1>

	<?php echo validation_errors(); ?>

	<form action="<?php echo site_url('playlists/create'); ?>" method="post">
		<div class="form-group">
			<label for="name">Nom de la Playlist</label>
			<input type="text" class="form-control" id="name" name="name" required>
		</div>
		<button type="submit" class="btn btn-primary">Créer</button>
	</form>
</div>

<?php $this->load->view('templates/footer'); ?>
