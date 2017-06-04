		<div class="main col-lg-11 col-md-12 col-sm-12 large-11 small-12 columns" id="pubic_timeline_section">
			<p><a href="/messages"><button class="btn button btn-secondary" id="refresh_button">Inbox</button></a> <a href="javascript:history.go(0);"><button class="btn button btn-success" id="refresh_button">Reload</button></a><p>
				<h2><?= $title ?></h2>
			<p>
				<? 	
				$posts_latest_first = $posts;
				?><table class="table table-hover table-responsive hover stack"><thead><tr><td>Message</td><td>From</td><td>Created</td></thead><tbody><?
					foreach ($posts_latest_first as $key => $value) {
						echo "<tr class='chat_inbox_list'><td class='message'>" . $value['chat'] . "</td><td class='message_from'>" . $value['users_from_login'] . "</td><td>" . $value['updated_at'] . "</td></tr>";
					} ?>
				</table>
			</p>
			<hr />
			<p class="menu_links" id="timeline_menu"><a href="/messages"><button class="btn btn-link button" id="to_upload_page"><span class="upload" id="upload_button_link">Inbox</span></button></a> <a href="/messages/create"><button id="create_post_button" class="button btn btn-link text-secondary">Create Post</button></a> <a href="/timeline/manage"><button id="manage_timeline_button" class="button btn btn-link text-secondary">Manage Timeline</button></a></p>
		</div>
