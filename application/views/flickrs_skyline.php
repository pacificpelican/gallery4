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
	</style>
	<script>window.twttr = (function(d, s, id) {
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
		<div id="blog_skyline_area_111a" class="aside col-md-4 medium-3 small-11 columns">
			<hr />
			<h7>share this photo:</h7>
			<p>
<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<!-- Your share button code -->
	<div class="fb-share-button" 
		data-href="<? echo SITE_URL . GALLERYS_FILE_URL . $file_name ?>" 
		data-layout="button">
	</div>

			</p>
			<p><a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?= $photo_title ?>" data-size="medium">
Tweet</a></p>
			<p><textarea id="one_link"><? echo SITE_URL . "/image/" . $file_name ?></textarea></p>
		</div>
		<div id="blog_skyline_area_111a" class="aside col-md-4 medium-3 small-11 columns">
			<hr />
			<h7>embed this photo on your site:</h7>
			<textarea id="sharing"><span class="djmblog_img_wrapper"><a href="<? echo SITE_URL . "/image/" . $file_name ?>"><img class="djmblog_image" id="<?= $photo_title ?>" src="<? echo SITE_URL . GALLERYS_FILE_URL . $file_name ?>" alt="<?= $photo_title ?>" /></span><span class="photo_caption"><?= $photo_title ?></a></span></textarea>
		</div>
		