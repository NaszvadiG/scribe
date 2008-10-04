<?php $this->load->view('admin/inc/header'); ?>

<div id="content">
	<h2 class="page-title">Posts : </h2>
	<?php if($query->num_rows()) { ?>
	<ul class="post-list">
	<?php foreach($query->result() as $row) : ?>
		<li>
			<span class="post-num"><?=$row->id;?></span>
			<span class="post-title"><a href="<?=base_url(); ?>admin/post/edit/<?=$row->id;?>"><?=$row->title;?></a></span>
			<span class="post-view"><a href="<?=base_url();?>post/<?=$row->id;?>">View</a></span>
			<span class="post-del"><a href="<?= base_url(); ?>admin/post/delete/<?=$row->id;?>" onclick="if ( confirm('You are about to delete this post \n  \'Cancel\' to stop, \'OK\' to delete.') ) { return true;} return false;">Delete</a></span>
		</li>
	<?php endforeach; ?>
	</ul>
	<?php } else { ?>
		<p>No posts yet. Why not create one?</p>
	<?php } ?>
	<p><a class="spl-link" href="<?=base_url();?>admin/post/new">Create a new post &raquo;</a></p>
</div>

<?php $this->load->view('admin/inc/footer'); ?>