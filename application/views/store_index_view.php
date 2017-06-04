		<div class="main col-md-9 col-sm-12 medium-9 small-12 columns" id="store_index_view">
			<h2><?= $title_on_page ?> <a href="/store/search" class="mag" id="link_to_search"><span class="small">&#128269;</span></a></h2>
			<p><ul>
				<?
				$posts_latest_first = $posts;
					foreach ($posts_latest_first as $key => $value) 
					{
						echo "<li class='store_products_list' id='" . $value['post_title']  . "'><a href='/product/" . $value['post_id'] . "'>" . $value['post_title'] . "</a></li>";
					} 
				?>
				</ul>
			</p>
			<p></p>
		</div>
