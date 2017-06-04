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
<body ng-app>
	<div class="container">
		<header class="header">
			<h1><a href="http://djmblog.com"><?= SITE_NAME ?></a> photos</h1>
		</header>
		<div class="main col-lg-9 large-9 columns">
			<p class="jumbotron photo_permalink" id="<?= $photo_title ?>_photo">
				<span class="img_wrapper"><a href="<? echo SITE_URL . GALLERYS_FILE_URL . $file_name ?>"><img class="album_image" id="<?= $photo_title ?>" src="<? echo SITE_URL . GALLERYS_FILE_URL . $file_name ?>" alt="<?= $photo_title ?>" /></span>
				<span class="photo_caption"><?= $photo_title ?></a></span>
				<span class="created_date"><small>uploaded: <?= $created ?></a> UTC</small></span>
			</p>
		</div>
	
		