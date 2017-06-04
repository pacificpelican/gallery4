		<div class="main login_page_area column large-5 medium-9 small-11" id="login_section">
			<h2>Login</h2>
			<form id="thelogin" action="/process/login" method="post">
				<span class="login_page_field">Login: <input type="text" id="userlogin" name="login" /></span>
				<span class="login_page_field">Password: <input type="password" id="userpass" name="password" /></span>
				<input type="submit" class="button" value="login" />
			</form>
		</div>
		<div class="main login_page_area column large-5 medium-9 small-11" id="register_section">
			<h2>Register</h2>
			<form id="thereg" action="/process/register" method="post">
				<span class="login_page_field">Login: <input type="text" id="userlogin" name="login" required /></span>
				<span class="login_page_field">Password: <input type="password" id="userpass" name="password" required /></span>
				<span class="login_page_field">Confirm Password: <input type="password" id="userpass" name="cpassword" required /></span>
				<span class="login_page_field">Email: <input type="text" id="useremail" name="email" required /></span>
				<input type="submit" class="button" value="register" />
			</form>
			<p class="text-warning">All capital letters in login will be made into small letters.  Password must be 7 characters or longer.  Email is required.</p>
		</div>
		<div class="main login_page_area column medium-12 small-12" id="help_link_section">
			<br /><p><a class="helplink" href="/help"><button class="button btn btn-warning purple_button">help</button></a></p>
		</div>
