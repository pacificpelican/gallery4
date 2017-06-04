		<div class="col-md-9 col-sm-12 medium-9 small-12 columns form-group main login_page_area" id="login_section">
			<h2>Add Payment Method</h2>
			<form id="thelogin" action="/process/add/card" method="post">
				<p><span class="pay_method_field">first name*: <input class="form-control" type="text" id="first_name_" name="first_name" /></span></p>
				<p><span class="pay_method_field">last name*: <input class="form-control" type="text" id="last_name_" name="last_name" /></span></p>
				<p><span class="pay_method_field">card number*: <input class="form-control" type="text" id="card_" name="card" /></span></p>
				<p><span class="pay_method_field">cvv 3 digit code: <input class="form-control" type="text" id="cvv_" name="cvv" /></span></p>
				<p id="month_exp_inp">
					expiration month*: 
					<select id="strainsource" name="expiration_month">
						<? 	$callie = cal_info(0);
							$calMonths = $callie['months'];
							$thisYear = date("Y");
							$theYearPlus = $thisYear + 25;
					 	?>
						<option value="0">choose month</option>
						<? 
						foreach ($calMonths as $key => $value) 
						{
							echo "<option value='" . $key . "'>" .  $value . "</option>";	
						}
						?>
					</select>
				</p>
				<p id="year_exp_inp">
					expiration year*: 
					<select id="strainsource" name="expiration_year">
						<option value="0">choose year</option>
						<? 
						for ($i=$thisYear; $i<$theYearPlus; $i++)
						{
							echo "<option value='" . $i . "'>" .  $i . "</option>";	
						}
						?>
					</select>
				</p>
				<p><span class="pay_method_field">address line 1*: <input class="form-control" type="text" id="address1" name="address_1" /></span></p>
				<p><span class="pay_method_field">address line 2: <input class="form-control" type="text" id="address2" name="address_2" /></span></p>
				<p><span class="pay_method_field">city*: <input class="form-control" type="text" id="city_" name="city" /></span></p>
				<p><span class="pay_method_field">state*: <input class="form-control" type="text" id="state_" name="state" /></span></p>
				<p><span class="pay_method_field">ZIP code*: <input class="form-control" type="text" id="ZIP_" name="ZIP" /></span></p>
				<p id="restaurant_inp">
					Card Type*: <select id="strainsource" name="provider">
					<option value="0">choose provider</option>
						<? 
							foreach ($suppliers as $key => $value) 
							{
								echo "<option value='" . $value['id'] . "'>" .  $value['name'] . "</option>";	
							}
						?>
				</select> 
			</p>
				<p><input type="submit" class="button btn btn-info" value="submit" /></p>
			</form>
			<p><a href="/"><button class="cancel btn btn-warning">cancel</button></a></p>
		</div>
		