		<div class="main col-md-9 col-sm-12 medium-9 small-12 columns">
			<h2><?= $title ?></h2>
				<?
				$posts_latest_first = $posts;
					foreach ($posts_latest_first as $key => $value)
					{
						echo "<div class='card blog_posts_list'><a href='/post/" . $value['post_id'] . "'>" . $value['post_title'] . " <a href='/post/" . $value['post_id'] ."/edit'><button class='delete_button button btn btn-primary'>edit</button></a> " . "<a href='process/post/delete/" . $value['post_id'] ."'><button class='delete_button button alert btn btn-warning'>delete</button></a> </div>";
					} ?>
			<p></p>
		</div>
