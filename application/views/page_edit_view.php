		<div class="form-group main post_edit_page_area col-md-11 page_edit_div medium-9 small-12 columns" id="page_edit_section">
			<h2>Edit Page</h2>
			<form id="thelogin" action="/process/page/edit" method="post">
				<p><span class="page_edit_field">Title: <input type="text" class="form-control" id="userlogin" name="title" value="<?= $title; ?>" /></span></p>
				<p>
					<span class="page_edit__page_field">
						Post: <textarea class="form-control" id="blogpost" rows="9" name="page"><? echo $post; ?></textarea>
					</span>
				</p>
				<p><span class="page_edit_field">alias [no spaces]: <input class="form-control" type="text" id="pod" name="alias" value="<?= $podcastPayload; ?>" /></span></p>
				<input type="hidden" value="<? echo $post_id; ?>" name="post_id" type="text" />
				<p><input type="submit" class="button btn btn-info" value="post" /></p>
			</form>
			<a href="/"><button class="cancel btn btn-warning">cancel</button></a>
		</div>
		