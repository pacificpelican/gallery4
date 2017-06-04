		<div class="main col-md-9 col-sm-12 medium-9 small-12 columns">
			<h2><?= $title ?></h2>
			<form id="the_checkout" action="/process/buy" method="post">
			<p><h6><span class="checkout_page_field"><input type="hidden" id="subtotal_" name="subtotal" value="<?= $subTotal ?>" /></span><label>Subtotal:</label> $<?= $subTotal; ?></h6></p>
			<p><h6><span class="checkout_page_field"><input type="hidden" id="tax_rate_" name="tax_rate" value="<?= $tax_rate ?>" /></span><label>Tax Rate:</label> <?= ($tax_rate*100) . "%"; ?></h6></p>
			<p><h6><span class="checkout_page_field"><input type="hidden" id="total_" name="total" value="<?= $tax_rate ?>" /></span><label>Total:</label> $<?= $total; ?></h6></p>
			<p>
				<label>promo code:</label> <input type="text" class="g" name="promo" />
			</p>
		<? if ($total > 0)
		{ ?>
			<p id="restaurant_card_inp"><p><label>Choose payment method:</label>
					<select id="card_source" name="provider">
					<option value="FALSE">choose card</option>
						<? 
							foreach ($payment_methods->result() as $row) 
							{
								echo "<option value='" . $row->id . "'>" .  "exp. " . $row->expiration_month . "/" . $row->expiration_year . "</option>";	
							}
						?>
				</select> 
			</p>
			<p><a href="/add/card">Add Payment Method</a></p>
				<p>
					<input type="submit" class="button btn btn-primary" value="Buy Now" />
				</p>
			</form>
			</p>
		<?	
		}
		elseif ((isset($itemCount)) && ($itemCount > 0)) 
		{
		 ?>
		 			<span class="checkout_page_field"><input type="hidden" id="userlogin" name="provider" value="null" /></span>
					<p><input type="submit" class="button btn btn-primary" value="Get Now" />
				</p>
			</form>
			</p>
		<? 
		}
		else {
			echo "</form></p>";
		} ?>

			<p><a href="/cart"><button class="cancel btn btn-warning">Cancel</button></a></p>
		</div>
