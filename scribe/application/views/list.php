<?php $this->load->view('inc/header'); ?>

<h2 class="page-title">Posts</h2>

<div class="prev-next">
	<?=$paginate;?><br />
</div>

<?php foreach($posts->result() as $post) : ?>

	<div class="post">
		
		<h3><a href="<?= base_url() . 'post/' . $post->id; ?>"><?= $post->title; ?></a></h3>
		<div class="metadata"><?= date('m/d/y', strtotime($post->date)); ?> by <?= ucwords($post->author); ?></div>
		<div class="entry">
			<?= $post->body; ?>
		</div>
		
	</div><!-- /post -->

<?php endforeach; ?>

<div class="prev-next">
	<?=$paginate;?><br />
</div>

<?php $this->load->view('inc/footer'); ?>