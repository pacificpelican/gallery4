		<div class="medium-9 small-12 columns col-md-9 col-sm-12 form-group main login_page_area" id="create_post_section">
			<h2>Create Photo Package</h2>
			<form id="thelogin" action="/process/packages/create" method="post">
				<p><span class="create_appointment_page_form_field">Description: <input class="form-control" type="text" id="userdesc" name="description" /></span></p>
				 <p><span class="create_appointment_page_form_field">Price: <input class="form-control" type="text" id="post_tags" name="price" /></span></p>
				 <p><span class="create_appointment_page_form_field">Prints:<input class="form-control" type="text" id="pod" name="prints" /></span></p>
				<p><input type="submit" class="button btn btn-info" value="post" /></p>
			</form>
			<p><a href="/photos/packages"><button class="cancel btn btn-warning button hollow warning">cancel</button></a></p>
		</div>
		