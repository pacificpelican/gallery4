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
	<script src="<? echo base_url() . '/assets/js/joeypc.js' ?>"></script>
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
	<div class="container">
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