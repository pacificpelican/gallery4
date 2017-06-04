		<div id="blog_post_area" class="main col-md-9 col-sm-12 medium-9 small-12 columns">
			<h2 class="page_title"><?= $title_main ?></h2>
			<p>
				<span class="small blog_post_date" id="post_date"><?= $post_date ?></span>
			</p>
			<p id='blog_writer'>
				<span class="small blog_post_writer writer <?= $writer ?>" id="<?= $users_id ?>"><? if ((isset($writer)) && ($writer !== "")) { echo "by " . $writer; } ?></span>
			</p>
			<p id="blog_post_content" class="HTML_content a_post"><? echo $post ?></p>
			<? if ((isset($podcastPayload)) && ($podcastPayload != null))
			{
				echo "<p id='pod'><span id='podlink'><a id='podcast_link' href='" . $podcastPayload . "'>Link to the Podcast</a></span></p>";
			}
			?>
		</div>
