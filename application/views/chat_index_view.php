		<div class="main col-lg-11 col-md-12 col-sm-12 medium-12 small-12 large-11 columns">
			<p class="upload_link"><a href="/timeline"><button class="button btn btn-secondary" id="to_upload_page"><span class="upload" id="upload_button_link">Timeline</span></button></a> <a href="javascript:history.go(0);"><button class="button btn btn-success" id="refresh_button">Reload</button></a> <a href="/messages/create"><button class="button btn btn-primary" id="to_upload_page"><span class="upload" id="upload_button_link">Compose</span></button></a> </p>
			<h2><?= $title ?></h2>
			<p>
				<? 	
				$posts_latest_first = $posts;
				?><table class="table table-hover table-responsive hover stack"><thead><tr><td>From</td><td>Message</td><td>Created</td><td>Action</td></thead><tbody>
				<?
					foreach ($posts_latest_first as $key => $value) 
					{
						echo "<tr class='chat_inbox_list'><td class='message_from'>" . $value['users_from_login'] . "</td><td class='message'>" . $value['chat'] . "</td><td>" . $value['updated_date'] . "</td><td><a class='btn btn-link button' href='/chat/create/id/" . $value['users_from_id'] . "'>reply" . "</a> <a class='btn btn-link button alert' href='/process/kill/chat/" . $value['id'] . "'>delete" . "</a></td></tr>";
					} ?>
				</table>
			</p>
			<hr />
			
		</div>
