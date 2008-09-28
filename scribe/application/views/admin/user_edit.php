<?php
	$this->load->view('inc/header');
?>

<div class="admin-form">

	<?php
		if($this->validation->error_string) {
			echo '<div class="error-msg">';
			echo $this->validation->error_string;
			echo '</div>';
		}
	?>

<?=form_open('admin/edit_info');?>
	<fieldset>
		<legend>Account Edit</legend>
		<p>
			<label for="username">Change username</label>
			<input type="text" name="username" value="" id="username" />
		</p>
		<p>
			<label for="old_pass">Old Password</label>
			<input type="password" name="old_pass" value="" id="old_pass" />
		</p>
		<p>
			<label for="password">New Password</label>
			<input type="password" name="password" value="" id="password" />
		</p>
		<p>
			<label for="passconf">Confirm Password</label>
			<input type="password" name="passconf" value="" id="passconf" />
		</p>
		<p>
			<button type="submit">Change</button>
		</p>
	</fieldset>
	
	<p class="return-admin"><?=anchor('admin/index', 'Return to admin home');?> | <?=anchor(base_url(),'Return to home');?></p>
	
<?=form_close('</div>');?>

<p></p>

<?php
	$this->load->view('inc/footer');
?>