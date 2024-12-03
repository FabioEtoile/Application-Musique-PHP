<?php $title = "Ma Librairie"; ?>
<?php $this->load->view('templates/header', ['title' => $title]); ?>

<div class="container mt-5">
	<h1 class="my-4"><?php echo $title; ?></h1>

	<form action="<?php echo site_url('playlists/create'); ?>" method="post">
		<div class="form-group">
			<label for="name">Nom de la Playlist</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Nom de la Playlist" required>
		</div>
		<button type="submit" class="btn btn-primary">Créer la Playlist</button>
	</form>

	<h2 class="my-4">Mes Playlists</h2>
	<?php if (empty($playlists)): ?>
		<p>Vous n'avez aucune playlist.</p>
	<?php else: ?>
		<ul>
			<?php foreach ($playlists as $playlist): ?>
				<li>
					<a href="<?php echo site_url('library/view_playlist/' . $playlist['id']); ?>"><?php echo $playlist['name']; ?></a>
					<a href="<?php echo site_url('library/delete_playlist/' . $playlist['id']); ?>" class="btn btn-danger btn-sm">x</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</div>

<?php $this->load->view('templates/footer'); ?>
