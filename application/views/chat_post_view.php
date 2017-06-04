		<div id="message_post_area" class="main col-md-9 col-sm-12 medium-9 small-12 columns">
			<h2 class="page_title"><?= $title_main ?></h2>
			<p>
				<span class="small message_post_date" id="post_date"><?= $post_date ?></span>
			</p>
			<p id='blog_writer'>
				<span class="small message_post_writer writer <?= $writer ?>" id="<?= $users_id ?>">by <?= $writer ?></span>
			</p>
			<p id="message_content" class="HTML_content message_post a_post"><? echo $post ?></p>
		</div>
