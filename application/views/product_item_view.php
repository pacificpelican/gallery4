		<div class="main col-md-9 col-sm-12 medium-9 small-12 columns" id="store_product">
			<h2><?= $title; ?></h2>
			<p>
				<span class="small blog_post_date item_updated_date" id="product_date"><?= $post_date; ?></span>
			</p>
			<p clas="product perma_link" id="product_page_content"><? echo $post; ?></p>
			<?
				if (($purchase_status == TRUE) && ($virt == 'TRUE'))
				{
					echo "<h6>You own a copy of this item</h6><a href='" . $url . "'><button class='cancel btn btn-success button success'>Download</button></a>";
				}
				else if ($post != 'NOT FOUND')
				{
					if (!(isset($quant)))
					{
						$quant = 1;
					}

					if ($price == 0)
					{
						$price = "Free";
					}
					else
					{
						$price = '$' . $price;
					}

					echo "<p><a href='/add/cart/" . $post_id . "/" . $quant . "'>" . "<button class='cancel btn btn-primary button'>Add To Cart</button></a></p>";
					echo "<p><span id='product_price' class='price'>" . $price . "</span></p>";
				}
				else
				{
					echo "<a href='/store'>" . "<button class='cancel btn btn-warning'>Return To Store</button></a>";	
				}
				?>
			</p>
			<p>
				<?
				if (($img != null) && ($img != FALSE) && ($img != 'FALSE') && ($img != 'undefined') && ($img != 'none'))
				{
					$pos = strpos($img, "ttp://");
					if ($pos == FALSE)
					{
						$this->load->helper('url');
	 					$siteURL = base_url();
	 					$imgDir = 'assets/images/store/';
	 					$imgURL = $siteURL . $imgDir . $img;
					}
					else
					{
						$imgURL = $img;
					}
					echo "<img id='product_image' class='img store_img' width='350' src='" . $imgURL . "' />";
				}
				?>
			</p>
		</div>
