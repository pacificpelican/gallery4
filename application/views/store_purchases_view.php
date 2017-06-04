		<div id="purchases_container" class="main col-md-9 col-sm-12 medium-9 small-12 columns">
			<h2><?= $title ?></h2>
			<p><ul>
				<? 	
				$posts_latest_first = $posts;
					foreach ($posts_latest_first as $value) {
						echo "<li class='blog_posts_list'><a href='/product/" . $value['products_id'] . "'>" . $value['product'] . "</a></li>";
					} 
					if ($posts == null) {
						echo "<li class='blog_posts_list'>No purchases to view. <p><a href='/store'>visit store</a></p></li>";
					} 
					?>
			</ul></p>
			<p></p>
		</div>
