		<div class="medium-9 small-12 columns col-md-9 col-sm-12 form-group main login_page_area" id="create_post_section">
			<h2>Create Blog Post</h2>
			<form id="thelogin" action="/process/blog/post" method="post">
				<p><span class="create_post_page_field">Title: <input class="form-control" type="text" id="userlogin" name="title" /></span></p>
				<P><span class="create_post_page_field blog_write_page_field">
					Post: <textarea class="form-control" id="post_field" rows="9" id="blogpost" name="post"></textarea>
				</span></p>
				 <p><span class="create_post_page_field">Tags (comma separated): <input class="form-control" type="text" id="post_tags" name="tags" /></span></p>
				 <p><span class="create_post_page_field">Podcast mp3 URL: <input class="form-control" type="text" id="pod" name="podcast_url" /></span></p>
				<p><input type="submit" class="button btn btn-info" value="post" /></p>
			</form>
			<p><a href="/"><button class="cancel btn btn-warning button hollow warning">cancel</button></a></p>
		</div>
		