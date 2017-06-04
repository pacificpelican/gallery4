			<div class="main col-md-9 col-sm-12 medium-9 small-12 columns">
			<h2><?= $title ?></h2>
			
			
		<!--	<p>
				<label>promo code:</label> <input type="text" class="g" name="promo" />
			</p>  -->
<form action="/process/buy" method="POST" id="payment-form">

	<p><h6><span class="login_page_field"><input type="hidden" id="userlogin" name="subtotal" value="<?= $subTotal ?>" /></span><label>Subtotal:</label> $<?= $subTotal; ?></h6></p>
			

		<? if ($total > 0)
		{ ?>

		<p><h6><span class="login_page_field"><input type="hidden" id="userlogin" name="tax_rate" value="<?= $tax_rate ?>" /></span><label>Tax Rate:</label> <?= ($tax_rate*100) . "%"; ?></h6></p>
		<p><h6><span class="login_page_field"><input type="hidden" id="userlogin" name="total" value="<?= $tax_rate ?>" /></span><label>Total:</label> $<?= $total; ?></h6></p>

	<div id="stripe_form" class="payment_form">
  		<h3>Pay using credit card with Stripe</h3>

  
    <span class="payment-errors"></span>



    <div class="form-row">
      <label>
        <span>Card Number</span>
        <input id="card_number_input" type="text" size="20" data-stripe="number"/>
      </label>
    </div>

    <div class="form-row">
      <label>
        <span>CVC</span>
        <input id="cvc_input" type="text" size="4" data-stripe="cvc"/>
      </label>
    </div>

    <div class="form-row">
    	<div class="medium-5">
		      <label>
		        <span>Expiration (MM/YYYY)</span>
		        <input id="month_" type="text" size="2" data-stripe="exp-month"/>
		      </label>
     		 <span> / </span>
        </div>
        <div class="medium-5">
      <input id="year_" type="text" size="4" data-stripe="exp-year"/>
  </div>
    </div>

   <p> <button class="btn btn-primary button" type="submit">Buy Now</button> </p>
  </form>
</div>
		
	<?	}
		elseif ((isset($itemCount)) && ($itemCount > 0)) 
		{
			
		 ?>
		 			<span class="login_page_field"><input type="hidden" id="userlogin" name="provider" value="null" /></span>
					<p><input type="submit" class="button btn btn-primary" value="Get Now" />
				</p>
			</form>
			</p>
		<? }
			else {
			//	echo "</form></p>";
			} ?>

			<p><a href="/cart"><button class="cancel btn btn-warning">Cancel</button></a></p>
		</div>


