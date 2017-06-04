		<div class="medium-9 medium-offset-1 small-11 small-offset-1 col-md-9 col-sm-12 form-group main login_page_area columns" id="file_upload_section">
			<h2>Book <a href="/myphotos">Photos</a> Session</h2>
			<? $this->load->helper('form'); ?>
			<? //	var_dump($appointments); ?>
			<span class="error_messages"><? if (isset($error)){ echo $error; } ?></span>
			<? echo form_open_multipart('process/gallerys/booking'); ?>
					<p><select name="bookingchoice">
					<? foreach ($appointments as $key => $value) {
					// var_dump($value);
					// echo "<br />";
					echo "<option value='" . $value['id'] . "'>" . $value['start'] . "</option>";
					}
					?>
				</select></p>
				<p><input class="btn" type="submit" value="select" /></p>
			</form>
			<p><a href="/"><button class="cancel btn btn-warning">cancel</button></a></p>
		</div>
		