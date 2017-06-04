		<div class="medium-9 small-12 columns form-group main post_edit_page_area col-md-9" id="blog_edit_section">
			<h2>Edit Blog Post</h2>
			<form id="thelogin" action="/process/blog/edit" method="post">
				<p><span class="blog_edit_ blog_edit_field">Title: <input type="text" class="form-control" id="userlogin" name="title" value="<?= $title; ?>" /></span></p>
				<p>
					<span class="blog_write_page_field blog_edit_">
						Post: <textarea class="form-control" id="blogpost" rows="9" name="post"><? echo $post; ?></textarea>
					</span>
				</p>
				<p><span class="blog_edit_ blog_edit_field">Podcast mp3 URL: <input class="form-control" type="text" id="pod" name="podcast_url" value="<?= $podcastPayload; ?>" /></span></p>
				<input type="hidden" value="<? echo $post_id; ?>" name="post_id" type="text" />
				<p><input type="submit" class="blog_edit_ button btn btn-info" value="post" /></p>
			</form>
			<a href="/"><button class="cancel btn btn-warning">cancel</button></a>
		</div>
		