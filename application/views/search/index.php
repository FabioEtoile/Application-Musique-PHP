<?php $title = "Recherche"; ?>
<h1 class="my-4"><?php echo $title; ?></h1>

<form action="<?php echo site_url('search/results'); ?>" method="get">
	<div class="form-group">
		<input type="text" class="form-control" name="q" placeholder="Rechercher...">
	</div>
	<button type="submit" class="btn btn-primary">Rechercher</button>
</form>
