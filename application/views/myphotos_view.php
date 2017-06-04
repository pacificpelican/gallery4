<!DOCTYPE html>
<html><!-- Ryukyu HTML5 starter index.html template 0.2.3 by Dan McKeown http://danmckeown.info -->
		<!-- copyright April-July 2015 Licensed under MIT license -->
<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../../assets/css/foundation.css" rel="stylesheet" />
	<link href="../../assets/css/myphotos.css" rel="stylesheet" />
	<script type="text/javascript" src="../../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../../assets/js/joeypc.js"></script>
	<script type="text/javascript" src="../../assets/js/ryukyu.js"></script>
</head>
<body>
	<div class="container">
		<div class="header medium-12 columns" id="announcement_center">
			<h1><? 	if (isset($brand))
					{
						echo "$brand";
					}
					else
					{
						echo "<a href='" . SITE_URL . "' rel='home'>" . SITE_NAME . "</a>";
					}
			?></h1>
			<p id="announcement" class="flashdata_info"><? $announcement = $this->session->flashdata('info');
					echo $announcement; ?>
			</p>
			<ul>
				<li>
					<a href="/myphotos/cart">Cart</a>
				</li>
				<li>
					<a href="/account"><button class="btn btn-primary" id="to_upload_page"><span class="upload" id="upload_button_link">Account</span></button></a>
				</li>
			</ul>
		</div>
		<div class="main" id="user_files_list">
			<h2 class="text-center"><?= $title ?></h2>
			<section class='waffle row'>
					<? 	
					$posts_latest_first = $posts;
					
						foreach ($posts_latest_first as $key => $value) {
							echo "<div class='myphotos myphotos_item waffle waffle-photo-item col col-lg-4 columns medium-4'>";
					//		echo "<tr class='blog_posts_list'><td class='file_link'>";
					//		echo "<a href='" . DROPBOXS_FILE_PATH_VIA_ROOT . $value['post_title'] . "'>" . $value['post_title'] . "</a>";
					//		var_dump($value);
							$img_tag = "<img src='." . GALLERYS_FILE_PATH . $value['post_title'] . "' />";
							echo $img_tag;

							if ($value['photo_state'] === "clean")
							{
								echo "<a href='/add/photocart/" . $value['post_id'] . "'><button class='btn btn-info button hollow add_cart_button_' id='photo_add_cart_button'>add to cart</button></a>";
							}
							if ($value['photo_state'] === "carted")
							{
								echo "<a href='/add/photocart/" . $value['post_id'] . "'><button disbaled class='disabled btn btn-info button hollow add_cart_button_' id='photo_add_cart_button'>add to cart</button></a><a href='/remove/photocart/" . $value['post_id'] . "'><button class='btn btn-alert button alert hollow remove_cart_button_' id='photo_remove_cart_button'>&#x2716</button></a>";
							}
							if ($value['photo_state'] === "owned")
							{
								echo "<a href='/add/photocart/" . $value['post_id'] . "'><button disbaled class='disabled btn btn-info button hollow add_cart_button_' id='photo_add_cart_button'>add to cart</button></a><a href='" . GALLERYS_FILE_PATH . $value['file_name'] . "'><button class='btn btn-success button success hollow download_pic_button_' id='photo_dl_pic_button'>download</button></a>";
							}
							
					//		echo "</td><td class='delete_link'><a href='/kill/file/" . $value['post_id'] . "'><span class='delete_it'>delete</span></td></tr>";
					//		echo "<p>photo state: " + $value['photo_state'] + "</p>";
							echo "</div>";
						} ?>
					<!-- </table>  -->
			</section>
		</div>
	</div>
	<footer class="footer medium-10 columns col-md-10">
		<br /><?= FOOTER_TEXT ?>
	
	</footer>
	<div class="bottom">
	</div>
</body>
</html>
