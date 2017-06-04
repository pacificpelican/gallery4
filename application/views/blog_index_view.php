		<div class="main medium-9 small-12 columns col-md-9 col-sm-12">
			<h2><?= $title_posts ?></h2>
			<p><ul>
				<? 	
				//	$posts_latest_first = array_reverse($posts);
				$posts_latest_first = $posts;
					foreach ($posts_latest_first as $key => $value) 
					{
						echo "<li class='blog_posts_list'><a href='/post/" . $value['post_id'] . "'>" . $value['post_title'] . "</a></li>";
					}
					if ($posts == null)
					{
						echo "<p><i>These links are here as placeholders because this site's database currently has no posts.</i></p>";
						echo "<li><a href='http://djmcloud.danieljmckeown.com/64/2015/12/09/camera-wolfing-podcast-154/' id='djmcloudPodcast154'>Camera wolfing</a></li>";
						echo "<li><a href='http://djmcloud.danieljmckeown.com/blog/2013/03/watts-obelisk/' id='watts'>Watts Obelisk</a></li>";
						echo "<li><a href='http://pacificarchives.sf3am.com/photos/2011/2092/0918145303/' id='travesers'>The point where Lake Michigan meets Grand Traverse Bay</a></li>";
						echo "<li><a href='http://pacificarchives.sf3am.com/diary/2010/01/795/01/' id='cle'>Downtown Cleveland at twilight</a></li>";
						echo "<li><a href='http://pacificarchives.sf3am.com/archives/pacific-ocean-at-dusk/' id='pacific'>Pacific Ocean at dusk</a></li>";
					}
				?>
			</ul></p>
			<p></p>
		</div>
