<?php $title = "Inscription"; ?>
<?php $this->load->view('templates/header', ['title' => $title]); ?>

<h1>Inscription</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('register/create_account'); ?>

<div class="form-group">
	<label for="pseudo">Pseudo</label>
	<input type="text" class="form-control" id="pseudo" name="pseudo" value="<?php echo set_value('pseudo'); ?>">
</div>

<div class="form-group">
	<label for="email">Email</label>
	<input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">
</div>

<div class="form-group">
	<label for="password">Mot de passe</label>
	<input type="password" class="form-control" id="password" name="password">
</div>

<button type="submit" class="btn btn-primary">S'inscrire</button>

<?php echo form_close(); ?>

<?php if (isset($success)): ?>
	<div class="alert alert-success" role="alert">
		<?php echo $success; ?>
	</div>
<?php endif; ?>

<?php if (isset($error)): ?>
	<div class="alert alert-danger" role="alert">
		<?php echo $error; ?>
	</div>
<?php endif; ?>

<?php $this->load->view('templates/footer'); ?>
