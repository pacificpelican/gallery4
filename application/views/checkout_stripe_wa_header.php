<!DOCTYPE html>
<html><!-- <? echo SITE_NAME ?> web app by Dan McKeown http://danmckeown.info -->
		<!-- copyright 2016 -->
<head>
	<title><? echo $title ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<? $this->load->helper('url'); ?>
	<link rel="stylesheet" type="text/css" href="<? echo base_url() . '/assets/css/bootstrap.css' ?>" />
	<link rel="stylesheet" type="text/css" href="<? echo base_url() . '/assets/css/djmblog.css' ?>" />
	<script src="<? echo base_url() . '/assets/js/jquery.js' ?>"></script>
	<script src="<? echo base_url() . '/assets/js/tether.js' ?>"></script>
	<script src="<? echo base_url() . '/assets/js/bootstrap.js' ?>"></script>

<!-- The required Stripe lib -->
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

  <!-- jQuery is used only for this example; it isn't required to use Stripe -->
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

  <script type="text/javascript">
    // This identifies your website in the createToken call below
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

  <script type="text/javascript">
  	$( document ).ready(function() {
	  	$('input[type=radio][name=total]').on('change', function() {
	     switch($(this).val()) {
	         case "<? echo $total ?>":
	         	$( "span#bottomline" ).html( "<? echo $total ?>" );
	    //     	$( "span.tax_data" ).html( "<input type='hidden' id='userlogin' name='tax_rate' value='<? echo $tax_rate ?>' />" );
	    		$("#taxunicorn").val("<? echo $tax_rate ?>");
	         	$( "span#taxratearea" ).html( "<?= ($tax_rate*100) . '%'; ?>" );
	          //   alert("Allot Thai Gayo Bhai");
	             break;
	         case "<?= $subTotal ?>":
	         	$( "span#bottomline" ).html( "<? echo $subTotal ?>" );
	    //     	$( "span.tax_data" ).html( "<input type='hidden' id='userlogin' name='tax_rate' value='0' />" );
	    		$("#taxunicorn").val("0");
	         	$( "span#taxratearea" ).html( "0%" );
	           //  alert("Transfer Thai Gayo");
	             break;
	     }
		});
	});

  </script>

</head>
<body>
	<nav class="navbar navbar-light bg-faded">
		  <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2">
		    &#9776;
		  </button>
		  <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
		<!--    <a class="navbar-brand" href="http://djmblog.com">djmblog.com</a> -->
		    <ul class="nav navbar-nav">
		    	<li class="nav-item active" id="home_ink"><a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a></li>
		    	<li class="nav-item" id="login_link"><a class="nav-link" href="/account">Account</a></li>
				<li class="nav-item" id="login_link"><a class="nav-link" href="/blog">Blog</a></li>
		      	<li class="nav-item">
		       		<a class="nav-link" href="/store">Store</a>
		      	</li>
		      	
		      <li class="nav-item">
		        <a class="nav-link" href="http://djmcloud.danieljmckeown.com/64/">Podcast</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="https://www.youtube.com/channel/UCWIpLyWRR4F0Zd9cWcyj6_g">Video</a>
		      </li>
		    </ul>
		  </div>
		</nav>
	<div class="container" id="checkout_container">
		<div class="header">
			<h1><? 	if (isset($brand)) 
					{
						echo "$brand";
					}
					else 
					{
						echo "<a href='" . SITE_URL . "' rel='home'>" . SITE_NAME . "</a>";
					} 
				?></h1>
			<p id="announcement" class="flashdata_info"><? $announcement = $this->session->flashdata('info');
					echo $announcement; ?>
			</p>
		</div>