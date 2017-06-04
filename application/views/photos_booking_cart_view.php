		<div class="main col-md-9 col-sm-12 medium-9 small-12 columns">
			<h2><?= $title ?></h2><!-- Photos Booking - Pick Package Page -->
				<?
				$posts_latest_first = $posts; ?>
			
				<? $this->load->helper('form'); ?>
				<span class="error_messages"><? if (isset($error)){ echo $error; } ?></span>
				<? echo form_open_multipart('process/gallerys/cart'); ?>
				<p><select name="packagechoice">
				<?	foreach ($posts_latest_first as $key => $value)
					{
					//	echo " $value['id'] .  $value['start'] . "";
						echo "<option value='" . $value['id'] . "'>" . " <span>" . $value['description'] . " price: $" . $value['price'] . "</span>" . " <span>prints: " . $value['prints'] . "</span> " . "</option>";
			
					} ?>
					</select></p>
				<p><input class="btn" type="submit" value="select" /></p>
			</form>
			<p></p>
		</div>
		

	