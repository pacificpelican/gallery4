			<div class="main col-md-9 col-sm-12 medium-9 small-12 columns" id="pay_site_section">
			<h2><?= $name1 ?></h2>
			
		<h4>This page is for sending money to <?= OWNER_NAME ?></h4>
    <form action="/process/pay" method="POST" id="payment-form">

	<p><span class="h6"><label>Your Total: $</label></span><span class="pay_page_field login_page_field"><input class="form-user-input" type="text" id="pay_amount" name="total" /></span></p>

	<div id="stripe_form" class="payment_form">
  	<h3>Pay using credit card with Stripe</h3>
  
    <span class="payment-errors"></span>

    <div class="form-row">
      <label>
        <span>Card Number</span>
        <input type="text" size="20" data-stripe="number"/>
      </label>
    </div>

    <div class="form-row">
      <label>
        <span>CVC</span>
        <input type="text" size="4" data-stripe="cvc"/>
      </label>
    </div>

    <div class="form-row">
      <label>
        <span>Expiration (MM/YYYY)</span>
        <input type="text" size="2" data-stripe="exp-month"/>
      </label>
      <span> / </span>
      <input type="text" size="4" data-stripe="exp-year"/>
    </div>

   <p> <button class="btn btn-primary button" type="submit">Pay Now</button> </p>
   </form>
  </div>
		
			<p><a href="/"><button class="cancel btn btn-warning">Cancel</button></a></p>

			<p class="terms_and_conditions privacy_policy">
				<a href='/terms' class='btn btn-info'>Terms and Conditions</a>
			</p>
			<p>
				<a href='/privacy' class='btn btn-info'>Privacy Policy</a>
			</p>
		</div>
<div id="34f">

</div>
