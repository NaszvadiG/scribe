<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Scribe Administration</title>
	
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/admin/master.css" type="text/css" media="screen" />
	
	<?php if($this->uri->segment('2') == 'post' && $this->uri->segment('3') == 'new') { ?>
	<script language="javascript" type="text/javascript" src="<?=base_url();?>assets/js/tinymce/tiny_mce.js"></script>
	<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,autosave,advimage",
		theme_advanced_buttons1 : "fontselect,fontsizeselect,|,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,undo,redo",
		theme_advanced_buttons2 : "bold,italic,underline,|,link,unlink,anchor,image,cleanup,code,|,forecolor,hr,charmap",
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		height : "250px",
		extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
	});
	</script>
	<?php } ?>
	
</head>

<body>
<div id="wrapper">

<div id="header">
	
	<div class="masthead">
		<h1>Scribe &mdash; Admin</h1>
		<p class="crumbs">
			<a href="<?= base_url(); ?>admin">Dashboard</a>
			<?php if($this->uri->segment('2')) { ?>
			&raquo;
			<?php $page = $this->uri->segment('2'); ?>
			<a href="<?= base_url(); ?>admin/<?=$page;?>"><?=ucwords($page);?></a>
			<?php } ?>
		</p>
	</div>
	<?php if($this->erkanaauth->try_session_login()) { ?>
	<div class="head-links">
		Logged in as <a href="<?= base_url(); ?>admin/user"><?= ucwords(getField('username')); ?></a> |  <a href="<?= base_url(); ?>admin/logout">Logout</a> | <a href="<?=base_url();?>">View Site</a>
	</div>
	<?php } ?>
		
</div><!-- /header -->

<div class="navigation">
<ul>
	<?php if($this->erkanaauth->try_session_login()) { ?>
	<li<?php if(!$this->uri->segment('2') || $this->uri->segment('2') == 'index') echo ' class="current"'; ?>><a href="<?= base_url(); ?>admin">Dashboard</a></li>
	<li<?php if($this->uri->segment('2') == 'post') echo ' class="current"'; ?>><a href="<?= base_url(); ?>admin/post">Posts</a></li>
	<li<?php if($this->uri->segment('2') == 'comments') echo ' class="current"'; ?>><a href="<?= base_url(); ?>admin/comments">Comments</a></li>
	<li<?php if($this->uri->segment('2') == 'theme') echo ' class="current"'; ?>><a href="<?= base_url(); ?>admin/theme">Theme</a></li>
	<li<?php if($this->uri->segment('2') == 'settings') echo ' class="current"'; ?>><a href="<?= base_url(); ?>admin/settings">Settings</a></li>
	<?php } else { ?>
	<li class="current"><a href="<?= base_url(); ?>admin/login">Login</a></li>
	<?php } ?>
</ul>
</div><!-- /navigation -->