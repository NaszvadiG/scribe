<?php $this->load->view('inc/admin_header'); ?>

<div id="content">
	<h2 class="page-title">Comments : </h2>
	<ul class="comment-list">
	<?php foreach($query->result() as $row) : ?>
		<li>
			<span class="comm-num"><?=$row->id;?></span>
			<div class="comm-text">
				<span class="comm-author"><a href="<?=base_url(); ?>admin/comments/edit/<?=$row->id;?>"><?=$row->name;?> on <?=$row->post_id;?></a></span>
				<div class="comm-body"><?=$row->body;?></div>
			</div>
			<span class="comm-del"><a href="<?= base_url(); ?>admin/comments/delete/<?=$row->id;?>" onclick="if ( confirm('You are about to delete this comment \n  \'Cancel\' to stop, \'OK\' to delete.') ) { return true;} return false;">Delete</a></span>
		</li>
	<?php endforeach; ?>
	</ul>
</div>

<?php $this->load->view('inc/admin_footer'); ?>