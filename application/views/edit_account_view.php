		<div class="main acct_page_area large-9 medium-10 small-11 columns" id="change_register_section">
			<?
		//	var_dump($loggedinfo);
			if ($loggedinfo != "nil")
			{
				echo "<p>$loggedinfo</p>";
			//	echo " <a href='edit/posts'><button class='btn btn-info'>Edit Posts</button></a></p>";
			}
			?>
			<h2>Log Out</h2>
			<p>
				<a href="/logout"><button id="red_theme_button" class="cancel button alert btn btn-danger">logout</button></a>
			</p>
			<h2>Edit Account</h2>
			<form id="thereg_change_1" action="/process/editlogin" method="post">
				<p>
					<span class="edit_page_field login_page_field">Login: <input type="text" id="userlogin" name="login" value="<?= $login1 ?>" /></span>
					<span class="edit_page_field login_page_field">Email: <input type="text" id="useremail" name="email"  value="<?= $email1 ?>" /></span>
					<span class="edit_page_field login_page_field">Name: <input type="text" id="user_name" name="name"  value="<?= $name1 ?>" /></span>
					<span class="edit_page_field login_page_field">URL: <input type="text" id="userURL" name="URL"  value="<?= $url1 ?>" /></span>
				</p>
				<p>
					<input type="submit" class="button btn btn-primary" value="submit" />
				</p>
			</form>
			<h2>Change Password</h2>
			<form id="thereg_change_1" action="/process/editpass" method="post">
				<p>
					<span class="edit_page_field login_page_field">New Password: <input type="password" id="userpass01" name="password" /></span>
					<span class="edit_page_field login_page_field">Confirm Password: <input type="password" id="userpass02" name="cpassword" /></span>
				</p>
				<p>
					<input type="submit" id="pw_change_submit" class="button btn btn-primary" value="submit" />
				</p>
			</form>
			<p><a href="/"><button id="cancel_button" class="cancel button orange_button btn btn-warning">cancel</button></a></p>
			<br /><p><a class="helplink" href="/help"><button class="button btn btn-warning purple_button">help</button></a></p>
		</div>
