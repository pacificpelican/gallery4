		<div class="medium-9 small-12 columns col-md-9 col-sm-12 form-group main message_compose_page_area" id="message_compose_section">
			<h2><?= $title ?></h2>
			<form id="thelogin" action="/process/chat/post" method="post">
				<p>To: <span class="login_page_field text-muted">[use <?= SITE_NAME ?> username to send a direct message, or 'public' to post to <a href='/timeline'><span class="text-muted">public timeline</span></a>]<input class="form-control" type="text" id="userlogin" name="users_to" placeholder="public" /></span></p>
				<P><span class="message_write_page_field">
					Message: <textarea class="form-control" rows="9" id="blogpost" name="chat"></textarea>
				</span></p>
				<p><input type="submit" id="send_message_button" class="button btn btn-info" value="send message" /></p>
			</form>
			<p><a href="/messages"><button id="cancel_button" class="cancel btn btn-warning button warning hollow">cancel and return to inbox</button></a></p>
		</div>
		