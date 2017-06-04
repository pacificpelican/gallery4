		<div class="col-md-9 col-sm-12 medium-9 small-12 columns form-group main login_page_area" id="create_post_section">
			<h2>Create Page</h2>
			<form id="page_creator" action="/process/page/post" method="post">
				<p><span class="create_post_page_field">Title: <input class="form-control" type="text" id="userlogin" name="title" /></span></p>
				<P><span class="create_post_page_field blog_write_page_field">
					Content: <textarea class="form-control" id="post_field" rows="9" id="blogpost" name="page"></textarea>
				</span></p>
				<p><input type="submit" class="button btn btn-info" value="post" /></p>
			</form>
			<p><a href="/"><button class="cancel btn btn-warning">cancel</button></a></p>
		</div>
		