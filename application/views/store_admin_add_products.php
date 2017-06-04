		<div class="col-md-9 col-sm-12 medium-9 small-12 columns form-group main login_page_area" id="store_add_products_section">
			<h2>Store Admin: Add Product</h2>
			<form id="thelogin" action="/process/store/products" method="post">
				<p><span class="store_add_products_field">Product*: <input class="form-control" type="text" id="userlogin" name="product" /></span></p>
				<p><span class="store_add_products_field">Price: $<input class="form-control" type="text" id="userlogin" name="price" /></span></p>
				<p><span class="store_add_products_field">Inventory: #<input class="form-control" type="text" id="userlogin" name="inventory" /></span></p>
				<p>Type of Product: </p><p><input class="form-control" type="radio" name="digital_bool" value="TRUE" checked /> Downloadable</p>
				<p><input class="form-control" type="radio" name="digital_bool" value="FALSE" /> Physical</p>
				<p><span class="store_add_products_field">URL: <input class="form-control" type="text" id="userlogin" name="URL" /></span></p>
				<P><span class="description_write_page_field store_add_products_">
					Description: <textarea class="form-control" rows="9" id="blogpost" name="description"></textarea>
				</span></p>
				<p><span class="store_add_products_field">Photo URL: <input class="form-control" type="text" id="userlogin" name="photo_url" /></span></p>
				<p id="restaurant_inp">
				Supplier*: <select id="strainsource" name="supplier">
					<option value="0">find supplier</option>
					<? 
					foreach ($suppliers as $key => $value) 
					{
						echo "<option value='" . $value['supplier'] . "'>" .  $value['supplier'] . "</option>";	
					}
					?>
				</select> or <a href="/add/supplier">add new supplier</a>
			</p>
				<p><input id="submit_button" type="submit" class="button btn btn-info" value="post" /></p>
			</form>
			<p><a href="/"><button id="cancel_button" class="cancel btn btn-warning">cancel</button></a></p>
		</div>
		