<script src="/assets/js/rotor010beta5babel.js"></script>
<script>
$(function() {
	$("button.next_image").click(function() {
				flipPic();
			});
	$("a.next_image").click(function() {
				flipPic();
			});
});
</script>
<style>
	body {
		background-color: FloralWhite;
	}
	svg {
		background-color: #ffffce;
		border-radius: 1.2em;
	}
	svg rect#the_flash, svg rect#bar {
	fill: FloralWhite;
	}
	svg rect#button2 {
	fill: darkgray;
	}
	svg rect#button1 {
	fill: darkblue;
	}
	svg circle {
	fill: #e6ee9c;
	}
	circle#secondCircle {
	fill: lightblue;
	}
	svg {
	height: 120px;
	width: 300px;
	}
	circle#firstCircleInner {
	fill: gray;
	}
	circle#secondCircleInner {
	fill: Cornsilk;
	}

	p#gallery4linkunderSVG a, p#gallery4linkunderSVG {
	font-family: Hack, "Fira Code", Menlo, mono, monospace;
	text-decoration: overline;
	color: orange;
	margin-left: 3em;
	margin-top: 0.2em;
	}
</style>

<link rel="stylesheet" href="/assets/css/j_photos_style.css" />
	
<div class="layout-split-4-2 page">
	<h1><span>Gallery 4</span>: <i>They just keep getting simpler.</i></h1>
		<aside role="complementary" class="column">
	    	<p>This site includes modules for a photo gallery site, a blog, and a file upload tool.</p>
		</aside>
	    
	<main role="main" class="column medium-4 column">
	    <h2>Features</h2>
	    <ol>
			<li><b>Photo Gallery Tools</b>: <a href="/album">Manage Photos</a> <span class="divider">|</span> <a href="/gallerys/upload">Upload</a></li>
			<li><a href="/blog"><b>Blog Engine</b>:</a> <a href="/blog">View</a> <span class="divider">|</span> <a href="/blogs/write">Create</a> <span class="divider">|</span> <a href="/edit/posts">Edit</a></li>
			<li><a href="/files"><b>File Manager</b>:</a> <a href="/files">View</a> <span class="divider">|</span> <a href="/files/upload">Upload</a> <span class="divider">|</span> <a href="/files">Manage</a></li>
	    </ol>

		<h3>Watermark</h3>
		<p>The watermark for image uploads is set in the config.php file.  This is the current one:</p>
		<p><a href="<?= WATERMARK_IMAGE_URL ?>"><img alt="watermark" src="<?= WATERMARK_IMAGE_URL ?>" /></a></p>
		
	</main><!-- End primary page content -->

	<aside role="complementary2" class="medium-4 column">

		<h2>For end users</h2>
		<ul>
			<li><a href="/photostream"><b>Photostream</b></a></li>
			<li><a href="/account">Account</a></li>
		</ul>

		<div id="gallery4svglogo">
			<svg id="vReelLogo">
				<rect id="bar" x="30" y="4" width="241" height="18"/>
				<rect id="the_flash" x="20" y="4" width="64" height="70"/>
				<rect id="button1" x="270" y="0" width="24" height="7"/>
				<rect id="button2" x="187" y="50" width="20" height="20"/>
				<circle id="firstCircle" cx="45" cy="32" r="20"/>
				<circle id="firstCircleInner" cx="140" cy="59" r="40"/>
				<circle id="secondCircle" cx="49" cy="32" r="20"/>
				<circle id="secondCircleInner" cx="139" cy="59" r="35"/>
			</svg>
			<p id="gallery4linkunderSVG">
 				<a href="http://gallery4.pacificio.com" target="_top">Gallery 4</a>
			</p>
		</div>

	</aside>

	<aside role="complementary3" class="medium-4 column">
		<h2>Links</h2>
		<ul>
			<li><a href="readme.md">readme</a></li>
			<li><a href="gallery4guide.md">Gallery 4 Guide document</a></li>
			<li><a href="todo.md">todo</a></li>
			
		</ul>

		<h3>Gallery 4 is inspired by but not affiliated with <a href="http://galleryproject.org/">Gallery</a> 3 and the code for Gallery 4 is based on LoveBird 0.9.9</h3>
		<li><a href="http://lovebird.pacificio.com"><b><i>lovebird web site</i></b></a></li>
		<li><a href="https://github.com/pacificpelican/lovebird"><b>lovebird GitHub</b></a></li>
		<h3>Gallery 4, like LoveBird, is free software.</h3>
		<h5>LoveBird is written in <a href="http://php.net">PHP</a> and is built on <a href="https://codeigniter.com/">CodeIgniter 3.1</a>.</h5>
		<p>Gallery 4 and LoveBird code is copyright (c) 2016-2017 <code><a href="http://danmckeown.info">Dan McKeown</a></code> and is released under <a href="../../LICENSE">the MIT License</a>.</p>
	</aside>
	
	</div>
