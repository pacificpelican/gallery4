<!DOCTYPE html>
<html><!-- LoveBird photo view by Dan McKeown http://danmckeown.info -->
<head>
	<title><?= $photo_info ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<? echo SITE_URL . '/assets/css/ryukyu.css' ?>" />
	<meta property="og:url"           content="<? echo SITE_URL . "/image/" . $file_name ?>" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="<?= SITE_NAME ?>" />
	<meta property="og:description"   content="<?= FOOTER_TEXT ?>" />
	<meta property="og:image"         content="<? echo SITE_URL . GALLERYS_FILE_URL . $file_name ?>" />
</head>
<script>
	nFile = "<?= $photo_object ?>";
	photo = nFile;
	console.log(nFile);
	</script>
	<style>
	:root{
		--main-color: #ffffff;
		--secondary-color: white;
		--header-color: #fff3e0;
		--main-height: 500px;
		
		--main-bg: rgb(255, 255, 255);
		--logo-border-color: lightgreen;
}

@media (max-width: 601px) 
{ 
  img {
    max-width: calc(100%);
  } 
  div.midHeader {
    background-color: var(--header-color);
  }
  div.container div.middleRow {
    height: 4em;
  }
}

@media (min-width: 600px) 
{ 
  img {
    max-width: calc(97%);
    height: calc(30vh + 19em);
  } 
  div.midHeader {
    background-color: var(--header-color);
  }
  div.container div.middleRow {
    width: 150px;
    height: calc(var(--main-height));
    border-top-right-radius: 5px;
  }
}

@media (min-width: 1400px) 
{ 
	div.middleRow {
		height: 7rem !important;
	}
	div#pcontent-below {
		height: 40rem !important;
	}
}

div#lowFooter {
  width: 910px;
}

div.container {
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
}

div#pcontent, div#pcontent-below, div#pcontent-below-2 {
  width: 910px !important;
}

div.container {
  font-family: Hack, Fira Sans, mono;
}

footer {
  font-family: Ubuntu Sans, Roboto, Helvetica, sans, mono;
}

div.container div.extra, div#pcontent {
  width: 150px;
  height: 100px;
  border-top-right-radius: 5px;
}

div.container div#pcontent-below {
  width: 150px;
  height: calc(var(--main-height));
  border-top-right-radius: 5px;
}

main {
  padding-left: 10px;
  padding-top: 10px;
}

div.DEFACE {
  background-color: #fff8e1;
}

div.EFFACE {
  background-color: #cccab5
}

div.DEEDED {
  background-color: #ffffcf;
}

div.BEDDED {
  background-color: #cccab5
}

div.DABBED {
  background-color: #ffffcf;
}

footer#name {
  margin-top: 100px;
}

div.FAD {
  background-color: #ffffef;
}

div.mainPhotoArea {
  background-color: var(--main-color);
  border: 1px solid black;
}

div.L-upper-sidebar {
  background-color: #fffde7;
}

div.ACCEDE {
  background-color: #cccab5;
}

div.BED {
  background-color: #fffde7;
}

div.ACE {
  background-color: #fffde7;
}
</style>
<style>
	textarea#sharing {
		width: 90%;
		height: 120px;
		border: 3px solid #cccccc;
		padding: 5px;
		font-family: Tahoma, sans-serif;
		background-position: bottom right;
		background-repeat: no-repeat;
	}

	main#photostream_link a, main#photostream_link a:visited {
		font-family: Hack, Menlo, monospace;
		font-size: 11px;
		font-weight: bold;
	}
</style>
<script>
	window.twttr = (function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0],
		t = window.twttr || {};
		if (d.getElementById(id)) return t;
		js = d.createElement(s);
		js.id = id;
		js.src = "https://platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js, fjs);
		
		t._e = [];
			t.ready = function(f) {
				t._e.push(f);
			};
		
		return t;
	}(document, "script", "twitter-wjs"));
</script>
	
<body ng-app>
	<div class="container">
		<div class="L-upper-sidebar extra">
			<main class="content">
			<p>
				<a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?= $photo_title ?>" data-size="medium">
					Share on Twitter
				</a>
			</p>
			</main>
		</div>
		<div id="pcontent" class="midHeader">
			<main class="content">
			<h2><?= SITE_NAME ?></h2>
			</main>
		</div>
		<div class="BED extra">
			<main id="photostream_link" class="content"><a href="/photostream"><span id="photostreamlink">Photostream</span></a></main>
		</div>
		<div class="BEDDED middleRow">
			<main class="content">
			<p class="img_caption">
				<span class="photo_caption"><?= $photo_title ?></a></span>
			</p>
			</main>
		</div>
		<div id="pcontent-below" class="mainPhotoArea extra">
			<main class="content">
				<span class="img_wrapper"><a href="<? echo SITE_URL . GALLERYS_FILE_URL . $file_name ?>"><img class="album_image" id="<?= $photo_title ?>" src="<? echo SITE_URL . GALLERYS_FILE_URL . $file_name ?>" alt="<?= $photo_title ?>" /></span>
			</main>
		</div>
		<div class="DABBED middleRow">
			<main class="content">	
				<p class="photo_metadata">
					<span class="created_date"><small>uploaded: <?= $created ?></a> UTC</small></span>
				</p>
			</main>
		</div>

		<div id="pcontent-below-2" class="DEFACE extra">
			<main class="content extra">
				<b>share this link:</b>
				<p>
		<textarea id="one_link"><? echo SITE_URL . "/image/" . $file_name ?></textarea>
	</p>
			</main>
		</div>
		<div class="ACCEDE extra">
		<hr />
			<div id="fb-root"></div>
				<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
				fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
				</script>
			<!-- Your share button code -->
			<div class="fb-share-button" 
				data-href="<? echo SITE_URL . GALLERYS_FILE_URL . $file_name ?>" 
				data-layout="button">
			</div>
		</div>
		<div class="DEEDED extra">
			<main class="content">
			
			</main>
		</div>
		<div class="FAD" id="lowFooter">
			<main class="content">
				<div id="blog_skyline_area_111a" class="aside col-md-4 medium-3 small-11 columns">
					<hr />
					<h7>embed this photo on your site:</h7>
					<textarea id="sharing"><span class="djmblog_img_wrapper"><a href="<? echo SITE_URL . "/image/" . $file_name ?>"><img class="djmblog_image" id="<?= $photo_title ?>" src="<? echo SITE_URL . GALLERYS_FILE_URL . $file_name ?>" alt="<?= $photo_title ?>" /></span><span class="photo_caption"><?= $photo_title ?></a></span></textarea>
				</div>
			</main>
		</div>
		<div class="ACE extra">
			<main class="content"></main>
		</div>
	</div>
	
<div id="blog_skyline_area_111a" class="aside col-md-4 medium-3 small-11 columns">

</div>
