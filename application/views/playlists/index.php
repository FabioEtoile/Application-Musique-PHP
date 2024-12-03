<?php $title = "Mes Playlists"; ?>
<?php $this->load->view('templates/header', ['title' => $title]); ?>

<div class="container mt-5">
	<h1>Mes Playlists</h1>
	<a href="<?php echo site_url('playlists/create'); ?>" class="btn btn-primary">Créer une nouvelle playlist</a>
	<ul>
		<?php foreach ($playlists as $playlist): ?>
			<li>
				<a href="<?php echo site_url('playlists/view/' . $playlist['id']); ?>"><?php echo $playlist['name']; ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>

<?php $this->load->view('templates/footer'); ?>
