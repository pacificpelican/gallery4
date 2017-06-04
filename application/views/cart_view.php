		<div class="main col-md-9 col-sm-12 medium-9 small-12 columns" id="cart_section">
			<h2><?= $title ?></h2>
			<p>
				<? 	
				//	$posts_latest_first = array_reverse($posts);
				$posts_latest_first = $cartData;
				?>
				<table class="table cart_table" id="cart_list">
					<thead>
						<tr>
							<td>product</td>
							<td>price</td>
							<td>quantity</td>
							<td>REMOVE</td>
						</tr>
					<thead>
					<tbody>
				<?
					$grandTotal = 0;
					$itemCount = 0;
					foreach ($posts_latest_first as $key => $value) {
						echo "<tr><td class='cart_posts_list'><a href='/product/" . $value['products_id'] . "'>" . $value['product'] . "</a></td>";
						echo "<td class='cart_posts_list'>" . $value['price'] . "</td>";
						echo "<td class='cart_posts_list'>" . $value['quantity'] . "</td>";
						echo "<td class='cart_posts_list'><a href='/process/cart/delete/" . $value['products_id'] . "/" . $value['quantity'] . "'>X</a></td></tr>";
						$grandTotal = $grandTotal + $value['price'];
						$itemCount = $itemCount + $value['quantity'];
					} 
					if ($itemCount == 0)
					{
						echo "<tr><td>no items in cart: <a href='/store'>view products</a></td></tr>";
					}
				?>
					</tbody>
				</table>
			</p>
			<p><h6>Subtotal: <?= $grandTotal; ?></h6></p>
			<? if ($itemCount > 0)
			{ ?>
				<p><a href="/checkout"><button class="checkout btn btn-primary">Check Out</button></a></p>
			<? } ?>
			
		</div>
