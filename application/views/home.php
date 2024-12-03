<?php $title = "Accueil"; ?>
<?php $this->load->view('templates/header', ['title' => $title]); ?>

<div class="container mt-5">
	<h1 class="my-4">Artistes du moment</h1>
	<div class="row">
		<?php foreach ($artists as $artist): ?>
			<div class="col-md-4 mb-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">
							<a href="<?php echo site_url('artists/view/' . $artist['id']); ?>">
								<?php echo $artist['name']; ?>
							</a>
						</h5>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<h1 class="my-4">Albums du moment</h1>
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
								<?php echo $album['name']; ?>
							</a>
						</h5>
						<p class="card-text"><?php echo $album['year']; ?></p>
						<p class="card-text"><strong>Genre:</strong> <?php echo $album['genre_name']; ?></p>
						<p class="card-text"><strong>Artiste:</strong>
							<a href="<?php echo site_url('artists/view/' . $album['artistId']); ?>">
								<?php echo $album['artist_name']; ?>
							</a>
						</p>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<?php $this->load->view('templates/footer'); ?>



