		<div class="main col-md-9 col-sm-12 medium-9 small-12 columns">
			<h2><?= $title ?></h2>
			<a href='/packages/create'><button class='create_button button hollow btn btn-primary primary'>create</button></a>
				<?
				$posts_latest_first = $posts;
					foreach ($posts_latest_first as $key => $value)
					{
						echo "<div id='" . $value['id'] . "' class='card blog_posts_list'><a href='#" . $value['id'] . "'>";
						echo $value['description'] . "</a>" . " <span>price: $" . $value['price'] . "</span>" . " <span>prints: " . $value['prints'] . "</span> " . "<a href='/process/packages/delete/" . $value['id'];
						echo "'><button class='delete_button button alert btn btn-warning'>delete</button></a> </div>";
					} ?>
			<p></p>
		</div>
