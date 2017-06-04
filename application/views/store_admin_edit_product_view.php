		<div class="col-md-9 col-sm-12 medium-9 small-12 columns form-group main login_page_area" id="store_edit_products_section">
			<h2>Store Admin: <?= $title ?></h2>
			<form id="theproducteditor" action="/process/store/edit/product" method="post">
				<p><span class="store_edit_products_field">Product*: <input class="form-control" type="text" id="userlogin" name="product" value="<?= $product ?>" /></span></p>
				<p><span class="store_edit_products_field">Price: $<input class="form-control" type="text" id="userlogin" name="price" value="<?= $price ?>" /></span></p>
				<p><span class="store_edit_products_field">photo URL: <input class="form-control" type="text" id="userlogin" name="photo_url" value="<?= $photo_url ?>" /></span></p>
				<? if ($digital_bool == "FALSE") 
					{
						echo "<p><span class='login_page_field'>Inventory: #<input class='form-control' type='text' id='userlogin' name='inventory' value='" . $inventory . "'></span></p>";
					}
					else
					{
						echo "<p><span class='login_page_field'>URL: <input class='form-control' type='text' id='userlogin' name='URL' value='" . $url . "' /></span></p>";
					}
				?>
				<P><span class="blog_write_page_field">
					Description: <textarea class="form-control" rows="9" id="blogpost" name="description"><?= $description ?></textarea>
				</span></p>
				<input type="hidden" name="id" value="<?= $products_id ?>" />
				<p><input type="submit" id="submit_button" class="button btn btn-info" value="post" /></p>
			</form>
			<p><a href="/"><button id="cancel_button" class="cancel btn btn-warning">cancel</button></a></p>
		</div>