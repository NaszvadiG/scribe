<?php $this->load->view('inc/admin_header'); ?>

<div id="content">
	<?php if($query->num_rows()=='0') die('No post with that id found.'); ?>
	<?php foreach($query->result() as $row) : ?>
	<?php echo $this->validation->error_string; ?>
	
	<?=form_open('admin/post/edit/'.$row->id, array('class' => 'content-form post-form'));?>
	<fieldset>
		<legend>Edit post</legend>
		<p><label for="title">Title : </label><input type="text" name="title" id="title" value="<?=$row->title;?>" /></p>
		<p><label for="post_body">Body : </label>
			<textarea name="post_body" id="post_body"><?=$row->body;?></textarea>
		</p>
		<p><button type="submit">Edit</button> <span class="del-btn"><a href="<?= base_url(); ?>admin/post/delete/<?=$row->id;?>" onclick="if ( confirm('You are about to delete this post \n  \'Cancel\' to stop, \'OK\' to delete.') ) { return true;} return false;">Delete</a></span></p>
	</fieldset>
	</form>
	<?php endforeach; ?>
</div>

<?php $this->load->view('inc/admin_footer'); ?>