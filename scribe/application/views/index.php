<?php $this->load->view('inc/header'); ?>

<div class="blog">
<?php foreach($posts->result() as $post) : ?>
	
	<div class="post">
		
		<h3><a href="<?= base_url() . 'post/' . $post->id; ?>"><?= $post->title; ?></a></h3>
		<div class="metadata"><?= date('m/d/y', strtotime($post->date)); ?> by <?= ucwords($post->author); ?></div>
		<div class="entry">
			<?= $post->body; ?>
		</div>
		
	</div><!-- /post -->
	
<?php endforeach; ?>

<div class="blog-pagination">
	<?=$paginate_posts;?>
</div>

</div><!-- /blog -->

<?php $this->load->view('inc/footer'); ?>