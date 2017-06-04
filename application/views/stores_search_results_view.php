		<div class="main search_page_area col-md-9 col-sm-12 medium-9 small-12 columns" id="search_query_results_section">
			<h2 id="store_search_result_header">Product <a href="/store/search">Search</a> Results</h2><br />
				<? foreach ($resultSet as $key => $product) { ?>
					<p class="search_results" id="sr_view">
						<span class="search_results_field qdata"><a href="/product/<?= $product['id'] ?>"><?= $product['name'] ?></a></span>
					</p>
				<? } ?>
		</div>

				