<div class="main col-md-9 col-sm-12 medium-9 small-12 columns" id="checkout_section">
	<h2><?= $title ?></h2>

	<? if ($total > 0)
		{ ?>
	<form action="/process/buy" method="POST" id="payment-form">

		<p><h6><span class="login_page_field"><input type="hidden" id="userlogin" name="subtotal" value="<?= $subTotal ?>" /></span><label>Subtotal:</label> $<?= $subTotal; ?></h6></p>
		<p><h6><span class="login_page_field tax_data"><input type="hidden" id="taxunicorn" name="tax_rate" value="<?= $tax_rate ?>" /></span><label>Tax Rate:</label> <span id="taxratearea" class="tax"><?= ($tax_rate*100) . "%"; ?></span></h6></p>

		<p><h6>Are you in Washington state?</h6>
			<span class="login_page_field">
				<input class="taxer" type="radio" name="total" value="<?= $total; ?>" checked> Yes I am in WA<br>
			  	<input class="taxer" type="radio" name="total" value="<?= $subTotal ?>"> No<br>
			</span>
		</p>
		<p><h6><span class="login_page_field"><input type="hidden" id="userlogin" name="total" value="<?= $tax_rate ?>" /></span><label>Total:</label> $<span id="bottomline" class="price_total user_totals"><?= $total; ?></span></h6></p>

		<div id="stripe_form" class="payment_form">
	  		<h3>Pay using credit card with Stripe</h3>
	  
	    	<span class="payment-errors"></span>

		    <div class="form-row">
		      <label>
		        <span>Card Number</span>
		        <input id="cc_num_inp" type="text" size="20" data-stripe="number"/>
		      </label>
		    </div>

		    <div class="form-row">
		      <label>
		        <span>CVC</span>
		        <input id="cc_cvc_inp" type="text" size="4" data-stripe="cvc"/>
		      </label>
		    </div>

		    <div class="form-row row">
		    	<div class="medium-5 column col-md-2">
		      <label>
		        <span>Expiration (MM)</span>
		        <input id="cc_mon_inp" type="text" size="2" data-stripe="exp-month"/>
		      </label>
		  </div>
		  <div class="medium-1 column col-md-1">
		  	<span> / </span>
		  </div>
		  <div class="medium-6 column col-md-2">
		  	  <label>
		        <span>Expiration (YYYY)</span>
		      <input id="cc_yr_inp" type="text" size="4" data-stripe="exp-year"/>
		  </label>
		  </div>
	    </div>

   		<p> <button class="btn btn-primary button" type="submit">Buy Now</button> </p>
  </form>
</div>
	<?	}
		elseif ((isset($itemCount)) && ($itemCount > 0)) 
		{
		 ?>
			<p><h6><span class="login_page_field"><input type="hidden" id="userlogin" name="subtotal" value="<?= $subTotal ?>" /></span><label>Subtotal:</label> $<?= $subTotal; ?></h6></p>

		 			<span class="login_page_field"><input type="hidden" id="userlogin" name="provider" value="null" /></span>
					<p><a href="/process/get"><button class="button btn btn-primary">Get Now</button></a>
				</p>
			
			</p>
		<? 
		}
		else 
		{
			//	do nothing
		} ?>
			<p><a href="/cart"><button class="cancel btn btn-warning">Cancel</button></a></p>
		</div>
