<?php $this->load->view('inc/admin_header'); ?>

<div id="content">
	
	<h2 class="page-title">Dashboard</h2>
	
	<ul class="dash-links">
		<li class="post-link"><a href="<?= base_url(); ?>admin/post/new">Write a new post</a></li>
		<li class="comments-link"><a href="<?= base_url(); ?>admin/comments/">View latest comments</a></li>
		<li class="themes-link"><a href="<?= base_url(); ?>admin/theme/">Edit the theme</a></li>
		<li class="settings-link"><a href="<?= base_url(); ?>admin/settings/">Change the settings</a></li>
	</ul>
	
</div><!-- /content -->

<?php $this->load->view('inc/admin_footer'); ?>