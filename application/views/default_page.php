<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<? $this->load->helper('url'); ?>
<link rel="stylesheet" type="text/css" href="<? echo base_url(); ?>assets/css/materialize.css">
	
</head>
<body>

<div class="container row">
	<h1>Welcome to CodeIgniter!</h1>

	<div class="body col s10 m10 offset-s2">
		
		<p>This is a default front page for a <a href="http://codeigniter.com">CodeIgniter</a> 3.0.4 setup.</p>

		<p>This setup is mostly stock but with a few modifications including:</p>
		<ul>
			<li>Set up database defaults for MAMP (except DB_name)</li>
			<li>config.php: $config['index_page'] = "";</li>
			<li>config.php: $config['global_xss_filtering'] = TRUE; *</li>
			<li>config.php: $config['base_url'] = 'http://localhost:8888/'; <i>for now, must be set for current server **</i></li>
			<li>routes.php: $route['default_controller'] = 'start';</li>
			<li>add assets directory--CSS on this page loads from it</li>
			<li>assets directory includes CSS and font for MaterializeCSS</li>

		</ul>
		<span class="foot_note" id="footnote1">* This XSS filtering feature is said to be deprecated in the comments.</span>
		<br />
		<span class="foot_note" id="footnote1">** The auto-detect for local server used to work in 3.0.0 but not anymore.</span>


		<p>This view is at:</p>
		<code>application/views/default_page.php</code>
		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Start.php</code>

		<p>Read the CodeIgniter <a href="user_guide/">User Guide</a>.</p>
	</div>
	<div class="row">
		<div class="body col s10 m9 offset-s2">
			<button><span id="pelican">setup by <a href="http://pacificpelican.us">pacificpelican.us</a></span></button>
			<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
		</div>
	</div>
</div>

</body>
</html>