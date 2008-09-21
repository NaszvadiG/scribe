<?php $this->load->view('inc/admin_header'); ?>

<div id="content">
	<?php if($query->num_rows()=='0') die('No post with that id found.'); ?>
	<?php foreach($query->result() as $row) : ?>
	<?php echo $this->validation->error_string; ?>
	
	<?=form_open('admin/comments/edit/'.$row->id, array('class' => 'content-form post-form'));?>
	<fieldset>
		<legend>Edit comment</legend>
		<p><label for="comment">Comment : </label>
			<textarea name="comment" id="comment"><?=$row->body;?></textarea></p>
		<p><label for="cname">Author : </label><input type="text" name="cname" id="cname" value="<?=$row->name;?>" /></p>
		<p><label for="email">Email : </label><input type="text" name="email" id="email" value="<?=$row->email;?>" /></p>
		<p><label for="website">Website : </label><input type="text" name="website" id="website" value="<?=$row->url;?>" /></p>
		<p><button type="submit">Edit</button> <span class="del-btn"><a href="<?= base_url(); ?>admin/comments/delete/<?=$row->id;?>" onclick="if ( confirm('You are about to delete this post \n  \'Cancel\' to stop, \'OK\' to delete.') ) { return true;} return false;">Delete</a></span></p>
	</fieldset>
	</form>s
	<?php endforeach; ?>
</div>

<?php $this->load->view('inc/admin_footer'); ?>