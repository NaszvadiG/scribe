<?php $this->load->view('inc/admin_header'); ?>

<div id="content">
	
	<?php echo $this->validation->error_string; ?>
	
	<?=form_open('admin/login', array('class' => 'content-form login-form'));?>
	<fieldset>
		<legend>Login</legend>
		<p><label for="username">Username : </label><input type="text" name="username" id="username" /></p>
		<p><label for="password">Password : </label><input type="password" name="password" id="password" /></p>
		<p><button type="submit">Login</button></p>
	</fieldset>
	</form>
</div>

<?php $this->load->view('inc/admin_footer'); ?>