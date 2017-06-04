<!DOCTYPE html>
<html><!--  -->
		<!-- copyright July 2016  -->
<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../../assets/css/ryukyu.css" rel="stylesheet" />
	<script type="text/javascript" src="../../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../../assets/js/joeypc.js"></script>
	<script type="text/javascript" src="../../assets/js/ryukyu.js"></script>

  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

  <script type="text/javascript">
    // This identifies this website in the createToken call below
    Stripe.setPublishableKey("<?= STRIPE_PUBLIC_API_KEY ?>");

    var stripeResponseHandler = function(status, response) {
      var $form = $('#payment-form');

      if (response.error) {
        // Show the errors on the form
        $form.find('.payment-errors').text(response.error.message);
        $form.find('button').prop('disabled', false);
      } else {
        // token contains id, last4, and card type
        var token = response.id;
        // Insert the token into the form so it gets submitted to the server
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // and re-submit
        $form.get(0).submit();
      }
    };

    jQuery(function($) {
      $('#payment-form').submit(function(e) {
        var $form = $(this);

        // Disable the submit button to prevent repeated clicks
        $form.find('button').prop('disabled', true);

        Stripe.card.createToken($form, stripeResponseHandler);

        // Prevent the form from submitting with the default action
        return false;
      });
    });
  </script>
</head>
<body class="photos_checkout_page">
	<div class="main col-md-6 col-sm-12 medium-6 small-12 columns" id="photo_package_checkout">
			<h2><?= SITE_NAME . " Photo Package Checkout" ?></h2><!-- Photos Booking - Pick Package Page -->
			<h4>Photos: <?= $package_info['prints'] ?></h4>
			
			<? $overall_total = $package_price; ?>
				<? $this->load->helper('form'); ?>
				<span class="error_messages"><? if (isset($error)){ echo $error; } ?></span>
				<?	// echo form_open_multipart('process/package/checkout'); ?>

				<form action="/process/package/checkout" method="POST" id="payment-form">
				
					<h2>Pay using Credit Card</h2>
			<h6>with <a href="https://stripe.com/">Stripe</a></h6>

		<p><h6><span class="login_page_field"><input type="hidden" id="total" name="total" value="<?= $overall_total ?>" /></span><label>Total:</label> $<?= $overall_total; ?></h6></p>	

			<div id="stripe_form" class="payment_form">
	  
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
			<p></p>
		</div>

	<div class="r_container">
		
		<div class="sidebar rc-m-6">

		

			<p><a href="/book"><button class="btn btn-warning button warning">Cancel</button></a></p>
			<h5><a href="/terms">Terms</a> ˙ <a href="/privacy">Privacy Policy</a></h5>
		</div>
	</div>
	
</body>
</html>
