		<div class="col-md-9 col-sm-12 medium-9 small-12 columns form-group main login_page_area" id="file_upload_section">
			<h2>Upload <a href="/files">File</a></h2>
			<? $this->load->helper('form'); ?>
			<span class="error_messages"><? if (isset($error)){ echo $error; } ?></span>
			<? echo form_open_multipart('process/upload'); ?>
				<p><input type="file" name="userfile" size="20" class="form-control" /></p>
				<p><input class="btn" type="submit" value="upload" /></p>
			</form>
			<p><a href="/files"><button class="cancel btn btn-warning">cancel</button></a></p>
		</div>
		