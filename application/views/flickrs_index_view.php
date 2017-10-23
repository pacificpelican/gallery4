		<div class="main col-md-9 col-sm-12 column large-11 small-12" id="user_files_list">
			<p class="upload_link"><a href="/gallerys/upload"><button class="btn btn-primary" id="to_upload_page"><span class="upload" id="upload_button_link">Upload</span></button></a></p>
			<h2><?= $title ?></h2>
			<p>
				<? 	
				$posts_latest_first = $posts;
				?><table class="table hover stack"><thead><tr><td>raw file name</td><td>photo page</td><td>action</td></thead><tbody><?
					foreach ($posts_latest_first as $key => $value) {
						echo "<tr class='blog_posts_list'><td class='file_link'><a href='" . DROPBOXS_FILE_PATH_VIA_ROOT . $value['post_title'] . "'>" . $value['post_title'] . "</a></td><td class='file_link'><a href='". SITE_URL . "/image/" . $value['thumbnail_title'] . "'>" . "link" . "</a></td><td class='delete_link'><a href='/flickrs/kill/file/" . $value['post_id'] . "'><button type='button' class='alert button'><span class='delete_it'>delete</span></button></td></tr>";
					} ?>
				</table>
			</p>
			
		</div>
