<!DOCTYPE html>
<html><!-- <? echo SITE_NAME ?> web app by Dan McKeown http://danmckeown.info -->
		<!-- copyright 2016 -->
<head>
	<title><? echo $title ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<? $this->load->helper('url'); ?>
	<link rel="stylesheet" type="text/css" href="<? echo SITE_URL . '/assets/css/materialize.css' ?>" />
	<script src="<? echo SITE_URL . '/assets/js/tether.js' ?>"></script>
	<script src="<? echo SITE_URL . '/assets/js/bootstrap.js' ?>"></script>
	<script src="<? echo SITE_URL . '/assets/js/joeypc.js' ?>"></script>
	<script>
		$( document ).ready(function() {
			$("button#random_light_background_button").click(function() {
				joeypc_random_light_background();
				joeypc_random_dark_text();
				joeypc_random_dark_links();
													});
			$("button#dark_theme_button").click(function() {
				joeypc_make_random_light_text();
				joeypc_make_random_light_links();
				joeypc_make_random_dark_background();
													});
			$("button#red_theme_button").click(function() {
				joeypc_random_colors_yellow_red();
				joeypc_change_link_color("#FFFFCC");
													});
										});
	</script>
</head>
<body>
