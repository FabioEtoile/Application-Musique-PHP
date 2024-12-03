<?php $this->load->view('templates/header', ['title' => $title]); ?>

<div class="container mt-5">
	<h1><?php echo $title; ?></h1>
	<form method="get" action="<?php echo site_url('albums/list'); ?>">
		<div class="form-group">
			<label for="sort_by">Trier par:</label>
			<select class="form-control" id="sort_by" name="sort_by">
				<option value="name" <?php echo ($sort_by == 'name') ? 'selected' : ''; ?>>Nom</option>
				<option value="year" <?php echo ($sort_by == 'year') ? 'selected' : ''; ?>>Date de sortie</option>
				<option value="genre_name" <?php echo ($sort_by == 'genre_name') ? 'selected' : ''; ?>>Genre</option>
				<option value="artist_name" <?php echo ($sort_by == 'artist_name') ? 'selected' : ''; ?>>Artiste</option>
			</select>
		</div>
		<div class="form-group">
			<label for="order">Ordre:</label>
			<select class="form-control" id="order" name="order">
				<option value="asc" <?php echo ($order == 'asc') ? 'selected' : ''; ?>>Croissant</option>
				<option value="desc" <?php echo ($order == 'desc') ? 'selected' : ''; ?>>Décroissant</option>
			</select>
		</div>
		<button type="button" class="btn btn-secondary" id="filter-by-genre-button">Filtrer par genre</button>
		<div class="form-group mt-3" id="genres-popup" style="display:none;">
			<label for="genres">Genres:</label>
			<select multiple class="form-control" id="genres" name="genres[]">
				<?php foreach ($genres as $genre): ?>
					<option value="<?php echo $genre['id']; ?>"><?php echo $genre['name']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Appliquer</button>
	</form>
	<div class="row mt-4">
		<?php foreach ($albums as $album): ?>
			<div class="col-md-4 mb-4">
				<div class="card">
					<?php if (!empty($album['cover_image'])): ?>
						<img src="data:image/jpeg;base64,<?php echo base64_encode($album['cover_image']); ?>" class="card-img-top" alt="<?php echo $album['name']; ?>">
					<?php endif; ?>
					<div class="card-body">
						<a href="<?php echo site_url('albums/view/' . $album['id']); ?>">
							<?php echo $album['name']; ?> (<?php echo $album['year']; ?>)
						</a>
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

<script>
	document.getElementById('filter-by-genre-button').addEventListener('click', function() {
		var genresPopup = document.getElementById('genres-popup');
		if (genresPopup.style.display === 'none') {
			genresPopup.style.display = 'block';
		} else {
			genresPopup.style.display = 'none';
		}
	});
</script>

<?php $this->load->view('templates/footer'); ?>

