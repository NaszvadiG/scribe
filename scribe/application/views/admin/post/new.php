<?php $this->load->view('inc/admin_header'); ?>

<div id="content">
	
	<?php echo $this->validation->error_string; ?>
	
	<?=form_open('admin/post/new', array('class' => 'content-form post-form'));?>
	<fieldset>
		<legend>Make a new post</legend>
		<p><label for="title">Title : </label><input type="text" name="title" id="title" /></p>
		<p><label for="post_body">Body : </label>
			<textarea name="post_body" id="post_body"></textarea>
		</p>
		<p><button type="submit">Post</button></p>
	</fieldset>
	</form>
	
</div>

<?php $this->load->view('inc/admin_footer'); ?>