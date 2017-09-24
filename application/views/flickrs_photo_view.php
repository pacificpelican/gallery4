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
  --main-color: pink;
  --secondary-color: white;
  --header-color: #DEEDED;
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
  background-color: #DEFACE;
}

div.EFFACE {
  background-color: #EFFACE;
}

div.DEEDED {
  background-color: #DEEDED;
}

div.BEDDED {
  background-color: #EFFACE;
}

div.DABBED {
  background-color: #DABBED;
}

footer#name {
  margin-top: 100px;
}

div.FAD {
  background-color: #FAD
}

div.mainPhotoArea {
  background-color: var(--main-color);
  border: 1px solid black;
}

div.L-upper-sidebar {
  background-color: #DAB
}

div.ACCEDE {
  background-color: #ACCEDE
}

div.BED {
  background-color: #BED
}

div.ACE {
  background-color: #ACE
}
</style>

<body ng-app>
	<div class="container">
		<div class="L-upper-sidebar extra">
			<main class="content">L upper sidebar</main>
		</div>
		<div id="pcontent" class="midHeader">
			<main class="content">
			SITE TITLE
			</main>
		</div>
		<div class="BED extra">
			<main class="content"><a href="/gallery">admin</a></main>
		</div>
		<div class="BEDDED middleRow">
			<main class="content">L Mid Sidebar</main>
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
				<p class="img_caption">
					<span class="photo_caption"><?= $photo_title ?></a></span>
				</p>
			</main>
		</div>
		<div class="ACCEDE extra">
			<main class="content">R lower sidebar</main>
		</div>
			<div class="DEEDED extra">
			<main class="content">Footer Sidebar L</main>
		</div>
		<div class="FAD" id="lowFooter">
			<main class="content">via "<a href="http://gallery4.pacificio.com">Gallery 4</a>" photo page <a href="https://codepen.io/pacificpelican/pen/RgvboZ">concept</a> by <a href="http://danmckeown.info">Dan McKeown</a></footer></main>
		</div>
		<div class="ACE extra">
			<main class="content">Footer Sidebar R</main>
		</div>
	</div>

