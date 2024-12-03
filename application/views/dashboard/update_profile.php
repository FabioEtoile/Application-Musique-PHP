<?php $title = "Mettre à jour le profil"; ?>
<?php $this->load->view('templates/header', ['title' => $title]); ?>

<h1 class="my-4">Mettre à jour le profil</h1>

<?php echo validation_errors(); ?>

<?php echo form_open('dashboard/update_profile'); ?>
<div class="form-group">
	<label for="pseudo">Pseudo</label>
	<input type="text" class="form-control" name="pseudo" value="<?php echo set_value('pseudo', $user['Pseudo']); ?>">
</div>
<div class="form-group">
	<label for="email">Email</label>
	<input type="email" class="form-control" name="email" value="<?php echo set_value('email', $user['Email']); ?>">
</div>
<button type="submit" class="btn btn-primary">Mettre à jour</button>
<?php echo form_close(); ?>

<?php $this->load->view('templates/footer'); ?>
