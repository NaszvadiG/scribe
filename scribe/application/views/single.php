<?php $this->load->view('inc/header'); ?>

<?php foreach($posts->result() as $post) : ?>
	
	<div class="post">
		
		<h3><a href="<?= base_url() . 'post/' . $post->id; ?>"><?= $post->title; ?></a></h3>
		<div class="metadata"><?= date('m/d/y', strtotime($post->date)); ?> by <?= ucwords($post->author); ?></div>
		<div class="entry">
			<?= $post->body; ?>
		</div>
		
	</div><!-- /post -->
	
<?php endforeach; ?>

<div class="comments">
	
	<h3>Comments on '<?= $post->title; ?>'</h3>
	<ol class="commentlist">
	<?php foreach($comments->result() as $comment) : ?>
		<li>
		 <?=$comment->name; ?> said on <?= date('m/d/y', strtotime($comment->date)); ?><br />
		 <?= $comment->body; ?>
		 <?php if($comment->url) echo $comment->url; else echo "no url"; ?>
		</li>
	<?php endforeach; ?>
	</ol>
	
	<div class="comment-form">
	<?= form_open('admin/comments/new') ?>
		
		<?= form_hidden('post_id',$this->uri->segment(2)); ?>
		
		<p><input type="text" value="" name="cname" id="cname" /></p>
		<p><input type="text" value="" name="email" id="email" /></p>
		<p><input type="text" value="" name="website" id="website" /></p>
		
		<p><textarea name="comment" id="comment"></textarea></p>
		
		<button type="submit">Submit</button>
		
		
	</form>
	</div>
	
</div><!-- /comments -->

<?php $this->load->view('inc/footer'); ?>