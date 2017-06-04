		<div class="col-md-9 col-sm-12 medium-9 small-12 columns form-group main login_page_area" id="store_add_suppliers_section">
			<h2>Store Admin: Add Supplier</h2>
			<form id="thelogin" action="/process/store/suppliers" method="post">
				<p><span class="store_add_suppliers_field">Supplier*: <input class="form-control" type="text" id="userlogin" name="supplier" /></span></p>
				<p><span class="store_add_suppliers_field">URL: <input class="form-control" type="text" id="userlogin" name="URL" /></span></p>
				<P><span class="write_description_field store_add_suppliers_">
					Description: <textarea class="form-control" rows="9" id="blogpost" name="description"></textarea>
				</span></p>
				<p><input id="submit_button" type="submit" class="button btn btn-info" value="post" /></p>
			</form>
			<p><a href="/"><button id="cancel_button" class="cancel btn btn-warning">cancel</button></a></p>
		</div>
		