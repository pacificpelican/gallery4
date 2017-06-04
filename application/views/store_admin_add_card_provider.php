		<div class="col-md-9 col-sm-12 medium-9 small-12 columns form-group main login_page_area" id="login_section">
			<h2>Store Admin: Add Payment Card Provider</h2>
			<form id="thelogin" action="/process/store/new/payment" method="post">
				<p><span class="admin_page_field">Name*: <input class="form-control" type="text" id="userlogin" name="name" /></span></p>
				<p><span class="admin_page_field">URL: <input class="form-control" type="text" id="userlogin" name="URL" /></span></p>
				<P><span class="admin_page_field">
					Description: <textarea class="form-control" rows="7" id="blogpost" name="description"></textarea>
				</span></p>
				<p><input type="submit" class="button btn btn-info" value="post" /></p>
			</form>
			<p><a href="/"><button class="cancel btn btn-warning">cancel</button></a></p>
		</div>
		