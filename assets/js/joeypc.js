//	joeypc JS/jQuery framework http://joeypc.com version 0.1.4 //
//	https://github.com/pacificpelican/joeypc //
//  copyright May-July 2015 by Dan McKeown http://danmckeown.info //
//	Licensed under MIT license //

;function joeypc() {
	console.log('joeypc runnning');
					}

function joeypc_change_text_color(color) {
	console.log('joeypc user-set text color changer runnning');
	var randomNumber = color;
  	$( "body" ).css( "color", randomNumber );
    console.log("changing text color to " + randomNumber);
										}

function joeypc_change_link_color(color) {
	console.log('joeypc user-set link color background changer runnning');
	var randomNumber = color;
  	$( "a" ).css( "color", randomNumber );
    console.log("changing link color to " + randomNumber);
										}

function joeypc_change_background(color) {
	console.log('joeypc user-set background changer runnning');
	var randomNumber = color;
  	$( "body" ).css( "background-color", randomNumber );
    console.log("changing background to " + randomNumber);
										}

function joeypc_random_text() {
	var randomNumber = "#";
	console.log('joeypc random text color runnning');
	for (i = 0; i < 6; i++) {
		var digit = Math.floor((Math.random() * 9) + 0);
		randomNumber = randomNumber + digit;
							}
		$( "body" ).css( "color", randomNumber );
	    console.log("changing text color to " + randomNumber);
								}

function joeypc_make_random_light_text() {
    var randomNumber = "#E";
		console.log('joeypc make random light text runnning');
		  for (i = 0; i < 1; i++) {
			  var digit = joeypc_random_digit();
				randomNumber = randomNumber + digit;
															}
				randomNumber = randomNumber + "E";
				 for (i = 0; i < 1; i++) {
				   var digit = joeypc_random_digit();
				 	randomNumber = randomNumber + digit;
				 												}
			randomNumber = randomNumber + "E";
			  for (i = 0; i < 1; i++) {
				  var digit = joeypc_random_digit();
					randomNumber = randomNumber + digit;
																}
			$( "body" ).css( "color", randomNumber );
			console.log("changing text color to " + randomNumber);
										}

function joeypc_random_dark_text() {
	var randomNumber = "#2222";
		console.log('joeypc random dark text runnning');
		for (i = 0; i < 2; i++) {
			var digit = Math.floor((Math.random() * 9) + 1);
			randomNumber = randomNumber + digit;
								}
		$( "body" ).css( "color", randomNumber );
	    console.log("changing text color to " + randomNumber);
									}

function joeypc_random_yellow_text() {
	var randomNumber = "#FFFF";
		console.log('joeypc random yellow text runnning');
		for (i = 0; i < 2; i++) {
			var digit = Math.floor((Math.random() * 9) + 1);
			randomNumber = randomNumber + digit;
								}
		$( "body" ).css( "color", randomNumber );
	    console.log("changing text color to " + randomNumber);
									}

function joeypc_random_reddish_text() 		{
	var randomNumber = "#FF";

	while (randomNumber.length != 7) {
		console.log('joeypc random reddish text runnning');
		var randomNumber = "#FF";
		for (i = 0; i < 3; i++) {
			var digit = Math.floor((Math.random() * 9) + 5);

			randomNumber = randomNumber + digit;
								}
	 		$( "body" ).css( "color", randomNumber );
	    console.log("changing text color to " + randomNumber);
	    							}
											}

function joeypc_random_link_color() {
	var randomNumber = "#";
	console.log('joeypc random link color runnning');
	for (i = 0; i < 6; i++) {
		var digit = Math.floor((Math.random() * 9) + 0);
		randomNumber = randomNumber + digit;
							}
		$( "a" ).css( "color", randomNumber );
	    console.log("changing text color to " + randomNumber);
									}

function joeypc_random_dark_links() {
	var randomNumber = "#2222";
		console.log('joeypc random dark link runnning');
		for (i = 0; i < 2; i++) {
			var digit = Math.floor((Math.random() * 9) + 1);
			randomNumber = randomNumber + digit;
								}
		$( "a" ).css( "color", randomNumber );
	    console.log("changing link color to " + randomNumber);
									}

function joeypc_make_random_light_links() {
    var randomNumber = "#E";
		console.log('joeypc make random light links runnning');
		  for (i = 0; i < 1; i++) {
			  var digit = joeypc_random_digit();
				randomNumber = randomNumber + digit;
									}
			randomNumber = randomNumber + "E";
				 for (i = 0; i < 1; i++) {
				   var digit = joeypc_random_digit();
				 	randomNumber = randomNumber + digit;
				 							}
			randomNumber = randomNumber + "E";
			  for (i = 0; i < 1; i++) {
				  var digit = joeypc_random_digit();
					randomNumber = randomNumber + digit;
											}
			$( "a" ).css( "color", randomNumber );
			console.log("changing link color to " + randomNumber);
										}

function joeypc_random_background() {
	console.log('joeypc random background runnning');
	var randomNumber = "#";
	for (i = 0; i < 6; i++) {
		var digit = Math.floor((Math.random() * 9) + 0);
		randomNumber = randomNumber + digit;
							}
 	$( "body" ).css( "background-color", randomNumber );
    console.log("changing background to " + randomNumber);
									}

function joeypc_make_random_dark_background() {
    var randomNumber = "#1";
		console.log('joeypc new random dark background runnning');
		  for (i = 0; i < 1; i++) {
			  var digit = joeypc_random_digit();
				randomNumber = randomNumber + digit;
													}
			randomNumber = randomNumber + "1";
				for (i = 0; i < 1; i++) {
				  var digit = joeypc_random_digit();
					randomNumber = randomNumber + digit;
														}
			randomNumber = randomNumber + "1";
			  for (i = 0; i < 1; i++) {
				  var digit = joeypc_random_digit();
					randomNumber = randomNumber + digit;
														}
			$( "body" ).css( "background-color", randomNumber );
			console.log("changing background color to " + randomNumber);
																}

function joeypc_make_random_bluish_dark_background() {
	var randomNumber = "#1";
		console.log('joeypc new random dark background runnning');
		for (i = 0; i < 1; i++) {
			var digit = joeypc_random_number_1_to_10();
			randomNumber = randomNumber + digit;
								}
			randomNumber = randomNumber + "1";
			for (i = 0; i < 1; i++) {
				var digit = joeypc_random_number_1_to_10();
				randomNumber = randomNumber + digit;
										}
			randomNumber = randomNumber + "2";
				for (i = 0; i < 1; i++) {
					var digit = joeypc_random_number_1_to_10();
						randomNumber = randomNumber + digit;
														}
				$( "body" ).css( "background-color", randomNumber );
						console.log("changing background color to " + randomNumber);
															}

function joeypc_random_light_background() {
	var randomNumber = "#F";
		console.log('joeypc new random light background runnning');
		for (i = 0; i < 1; i++) {
			var digit = Math.floor((Math.random() * 9) + 1);
			randomNumber = randomNumber + digit;
								}
		randomNumber = randomNumber + "F";
		for (i = 0; i < 1; i++) {
			var digit = Math.floor((Math.random() * 9) + 1);
			randomNumber = randomNumber + digit;
								}
		randomNumber = randomNumber + "F";
		for (i = 0; i < 1; i++) {
			var digit = Math.floor((Math.random() * 9) + 1);
			randomNumber = randomNumber + digit;
								}
		$( "body" ).css( "background-color", randomNumber );
	    console.log("changing background color to " + randomNumber);
									}

function joeypc_random_reddish_light_background() {
	var randomNumber = "#FF";
	while (randomNumber.length != 7) {
		console.log('joeypc random reddish background runnning');
		var randomNumber = "#FF";
		for (i = 0; i < 3; i++) {
			var digit = Math.floor((Math.random() * 9) + 5);
			randomNumber = randomNumber + digit;
								}
	 	$( "body" ).css( "background-color", randomNumber );
	    console.log("changing background to " + randomNumber);
	    							}
													}

function joeypc_random_yellow_background() {
	var randomNumber = "#FFFF";
		console.log('joeypc random yellow background runnning');
		for (i = 0; i < 2; i++) {
			var digit = Math.floor((Math.random() * 9) + 1);
			randomNumber = randomNumber + digit;
								}
	 	$( "body" ).css( "background-color", randomNumber );
	    console.log("changing background to " + randomNumber);
	    									}

function joeypc_random_pink_background() {
	var randomNumber = "#F";
		console.log('joeypc new random light background runnning');
		for (i = 0; i < 1; i++) {
			var digit = Math.floor((Math.random() * 9) + 1);
			randomNumber = randomNumber + digit;
								}
		randomNumber = randomNumber + "F";
		$( "body" ).css( "background-color", randomNumber );
	    console.log("changing text color to " + randomNumber);
									}

function joeypc_random_dark_text_on_light_background_with_dark_links() {
	joeypc_random_dark_text();
	joeypc_random_light_background();
	joeypc_random_dark_links();
															}

function joeypc_random_colors_yellow_red() {
	joeypc_random_yellow_text();
	joeypc_random_reddish_light_background();
	var randomNumber = "#FFFF";
		console.log('joeypc random yellow link color (subroutine) runnning');
		for (i = 0; i < 2; i++) {
			var digit = Math.floor((Math.random() * 9) + 1);
			randomNumber = randomNumber + digit;
								}
		$( "a" ).css( "color", randomNumber );
	    console.log("changing link text color to " + randomNumber);
											}

function joeypc_reload_page() {
	    	document.location.reload(true);
	    						}

function joeypc_old_random_light_background() {
	var randomNumber = "#FFF";
		console.log('joeypc random light background runnning');
		for (i = 0; i < 3; i++) {
			var digit = Math.floor((Math.random() * 9) + 1);
			randomNumber = randomNumber + digit;
								}
		$( "body" ).css( "background-color", randomNumber );
	    console.log("changing background color to " + randomNumber);
									}

function joeypc_random_number() {
	var newdigit = Math.floor((Math.random() * 9) + 1);
	return newdigit;
	//    deprecated in favor of below 2 functions:
								}

function joeypc_random_number_1_to_10() {
	var newdigit = Math.floor((Math.random() * 9) + 1);
	return newdigit;
								}

function joeypc_random_digit() {
	var newdigit = Math.floor((Math.random() * 9) + 1);
	return newdigit;
								}

function joeypc_random_light_text_on_dark_background_with_light_links() {
	joeypc_make_random_dark_background();
	joeypc_make_random_light_text();
	joeypc_make_random_light_links();
}

function joeypc_random() {
	console.log('joeypc random runnning ');
	var d = new Date();
	var n = d.getSeconds();
	var digit = Math.floor((Math.random() * 67) + 0) + n;
	console.log(digit + "  ");
	return digit;
						}

function joeypc_get_longest_word_in_sentence(string) {
	var string1 = string;
	var leng = string1.length
	var wordbox = [];
	var wordboxcount = 0;
	for (i=0; i<leng; i++) {
		if (string1[i] == " ") {
			// mark this as space between the end of a word, beginning of another
			wordboxcount++;
		}
		if (string1[i] != " ") {
			// absorb this string into the current word
			if (wordbox[wordboxcount]) {
			wordbox[wordboxcount] = wordbox[wordboxcount] + string1[i];
										}
			else  {
			wordbox[wordboxcount] = string1[i];
										}
		}
	}
	var leng2 = wordbox.length;
	var currentMax = 0;
	var longest;
	var newlimit = 0;
	for (i=0; i<leng2; i++) {
			if (wordbox[i]) {
		leng3 = wordbox[i].length;
		if (leng3 > currentMax) {
			longest = wordbox[i];
			currentMax = wordbox[i].length;
							}
								}
							}
	return longest;
													}

function joeypc_maxMinAvg(arr) {
	console.log('joeypc maxMinAvg runnning');
		var max = arr[0];
		var min = arr[0];
		var sum = 0;
		var avg;
	    for (i = 0; i < arr.length; i++) {
	    	if (arr[i] > max) {
	        	max = arr[i];
	        	sum = sum + arr[i]

	                        }
	    	else if (arr[i] < min) {
	        	min = arr[i];
	        	sum = sum + arr[i]
	                              }
	      	else {
	        	sum = sum + arr[i];
	          	}
	                              }
	    avg = sum/arr.length
	    var result = "max: " + max + " " + "min: " + min + " " + "avg: " + avg ;
	    console.log("returning " + result);
	    return result;
									}

joeypc();
