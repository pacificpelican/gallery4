		<div id="page_view_section" class="main col-md-11 col-sm-12 medium-11 small-12 columns">
			<h2 class="page_title"><?= $title_main ?></h2>
			<p id="page_date">
				<span class="small page_post_date" id="post_date"><?= $post_date ?></span>
			</p>
			<p id='page_writer'>
				<span class="small page_writer writer <?= $writer ?>" id="<?= $users_id ?>"></span>
			</p>
			<p id="page_content" class="HTML_content a_post"><? echo $post ?></p>
		</div>
