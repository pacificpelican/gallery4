		<div class="main col-md-9 col-sm-12 medium-9 small-12 columns" id="store_admin_product_list_section">
			<h2><?= $title ?></h2>
				<? 	
				$posts_latest_first = $posts;
					foreach ($posts_latest_first as $key => $value) {
						echo "<div class='card blog_posts_list'><a href='/product/" . $value['products_id'] . "'>" . $value['product'] . " <a href='/admin/store/edit/product/" . $value['products_id'] ."'><button class='delete_button btn btn-primary button'>edit</button></a> " . "<a href='/process/admin/product/delete/" . $value['products_id'] ."'><button class='delete_button btn btn-warning button alert'>delete</button></a> </div>";
					} ?>
			
			<p></p>
		</div>
