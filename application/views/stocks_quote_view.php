	<style>
		footer#bottom_footer p a {
			color: black;
		}
	</style>
	<script type="text/javascript">
		$( document ).ready(function() {
			var ticker;

			$( ".sclick" ).click(function() {
  		
	  			ticker = $( "input#stocksymbol" ).val();
	  			console.log(ticker);
	  			joeypc_random_light_background();
	  		
	  			var data;
	  			var price;
			  	var $getURL = "http://dev.markitondemand.com/MODApis/Api/v2/Quote/jsonp?symbol=" + ticker;
			  	z = $.ajax({
			   	type: "GET",
			   	url: $getURL,
			   	dataType: "jsonp",
			   	success: function(data){ //only the data object passed to success handler with JSON dataType
	                console.log(data);
					console.log(data.LastPrice);
					price = data.LastPrice;
					if ((price != 'undefined') && (price != null))
					{
						$('span.ticker').text(ticker + ": $" + price);
					}
					else
					{
						$('span.ticker').text('ERROR in processing quote.');
					}
					
	            },
			   	error: function (xhr, ajaxOptions, thrownError) {
			   		console.log('error: ' + thrownError);
					$('span.ticker').text('ERROR in looking up quote.');
			   	}

				});
			});
		});
	</script>

	<div class="container col-lg-5 col-md-6 col-sm-11 col-xs-12 large-5 small-11 columns" id="stock_quote_container">
		<header class="header">
			<h1>Stock Quote Page</h1> powered by <a href="http://dev.markitondemand.com">dev.markitondemand.com</a>
		</header>
		<main class="main">
			<p class="text-info">This page looks up share price.</p>
			<p></p>
			<div class="quote" id="stock_quote"> 
				<p id="the_quote"><span id="stock_quote_content" class="ticker"></span></p>
			</div>

			<p><div id="thebutton2b"><a href="#" id="reloadpagelink"></a></div></p>
			<p><form id="thelogin" action="#" method="post">
				<p><span class="sclick login_page_field">Stock symbol: <input class="form-control" type="text" id="stocksymbol" name="ticker" value="aapl" /></span></p>
				<input type="hidden" name="id" value="null" />
				
			</form>
			<a href="#"><button class="sclick btn btn-success" id="quote_button">get quote</button></a>
		</p>
		</main>
		<aside class="sidebar">
			<p></p>
		</aside>
		
	</div>
