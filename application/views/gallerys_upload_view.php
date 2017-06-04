		<div class="medium-9 medium-offset-1 small-11 small-offset-1 col-md-9 col-sm-12 form-group main login_page_area columns" id="file_upload_section">
			<h2>Upload <a href="/album">Photos</a></h2>
			<? $this->load->helper('form'); ?>
			<span class="error_messages"><? if (isset($error)){ echo $error; } ?></span>
			<? echo form_open_multipart('process/gallerys/upload'); ?>
				<p><label>gallery name</label><input type="text" name="gallery_name" id="gallery-name-input" class="form-control" /></p>
				<p><label>photos</label><input multiple="" type="file" name="userfiles[]" size="20" class="form-control" /></p>
				<p><label>customer</label><select id="customer_name" name="users_id">
					<option value='null'>pick user</option>
					<? foreach ($all_users as $key => $value) {
					echo "<option value='" . $value['users_id'] . "'>" . $value['login'] . "</option>";
					}
					?>
				</select></p>
				<p><input class="btn" type="submit" value="upload" /></p>
			</form>
			<p><a href="/files"><button class="cancel btn btn-warning">cancel</button></a></p>
		</div>
		