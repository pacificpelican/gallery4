<!DOCTYPE html>
<html><!-- <? echo SITE_NAME ?> web app by Dan McKeown http://danmckeown.info -->
		<!-- copyright 2016-2017 -->
<head>
	<title><? echo $title ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<? $this->load->helper('url'); ?>

<style>
div.contactSheetContainer {
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
}

section {
  margin-right: 0.1em;
  margin-bottom: 0.2em;
}

section main {
  max-width: 200px;
  background-color: lightgray;
}

section aside {
  background-color: floralWhite;
  font-family: Helvetica, "Lucida Grande", sans-serif;
  padding-left: 0.2em;
}

img {
  max-width: 99%;
}
</style>

</head>
<body>
	