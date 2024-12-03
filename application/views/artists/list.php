<?php $title = "Liste des Artistes"; ?>
<?php $this->load->view('templates/header', ['title' => $title]); ?>

<div class="container mt-5">
	<h1 class="my-4"><?php echo $title; ?></h1>

	<div class="mb-3">
		<a href="<?php echo site_url('artists/list'); ?>" class="btn btn-secondary">Par défaut</a>
		<a href="<?php echo site_url('artists/list?sort=name&order=ASC'); ?>" class="btn btn-secondary">Trier par nom (A-Z)</a>
		<a href="<?php echo site_url('artists/list?sort=name&order=DESC'); ?>" class="btn btn-secondary">Trier par nom (Z-A)</a>
	</div>

	<?php if (!empty($artists)): ?>
		<ul class="list-group">
			<?php foreach ($artists as $artist): ?>
				<li class="list-group-item">
					<a href="<?php echo site_url('artists/view/' . $artist['id']); ?>"><?php echo $artist['name']; ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else: ?>
		<p>Aucun artiste trouvé.</p>
	<?php endif; ?>
</div>

<?php $this->load->view('templates/footer'); ?>
