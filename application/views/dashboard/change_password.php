<?php $title = "Changer le mot de passe"; ?>
<?php $this->load->view('templates/header', ['title' => $title]); ?>

<h1 class="my-4">Changer le mot de passe</h1>

<?php echo validation_errors(); ?>
<?php if ($this->session->flashdata('error')): ?>
	<div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<?php echo form_open('dashboard/change_password'); ?>
<div class="form-group">
	<label for="old_password">Ancien mot de passe</label>
	<input type="password" class="form-control" name="old_password" required>
</div>
<div class="form-group">
	<label for="new_password">Nouveau mot de passe</label>
	<input type="password" class="form-control" name="new_password" required>
</div>
<div class="form-group">
	<label for="confirm_password">Confirmer le nouveau mot de passe</label>
	<input type="password" class="form-control" name="confirm_password" required>
</div>
<button type="submit" class="btn btn-primary">Changer le mot de passe</button>
<?php echo form_close(); ?>

<?php $this->load->view('templates/footer'); ?>
