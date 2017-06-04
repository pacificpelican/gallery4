		<div class="medium-9 small-12 columns col-md-9 col-sm-12 form-group main login_page_area" id="create_post_section">
			<h2>Create Available Appointment</h2>
			<form id="thelogin" action="/process/appointments/create" method="post">
				<p><span class="create_appointment_page_form_field">Description: <input class="form-control" type="text" id="userlogin" name="appointment_date" /></span></p>
				 <p><span class="create_appointment_page_form_field">Start time [alpha]: <input class="form-control" type="datetime-local" id="post_tags" name="start" /></span></p>
				 <p><span class="create_appointment_page_form_field">End time [alpha]:<input class="form-control" type="datetime-local" id="pod" name="end" /></span></p>
				<p><input type="submit" class="button btn btn-info" value="post" /></p>
			</form>
			<p><a href="/"><button class="cancel btn btn-warning button hollow warning">cancel</button></a></p>
		</div>
		