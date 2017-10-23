		<div class="main col-md-9 col-sm-12 column large-11 small-12" id="user_files_list">
			<h2><?= $title ?></h2>
			<div class="contactSheetContainer">
				<?	
				$posts_latest_first = $posts;
				?><table class="table hover stack"><tbody>
        <?
					foreach ($posts_latest_first as $key => $value) {
            echo "<section class='oneImage'>";
            echo "<main class='img_holder'>";
              echo "<a class='img_link' href='". SITE_URL . "/image/" . $value['post_title'] . "'><img src='" . DROPBOXS_FILE_PATH_VIA_ROOT . $value['post_title'] . "'></img></a>";
            echo "</main><aside class='img_caption'>";
            echo "</aside>";
          echo "</section>";
					//	echo "<tr class='blog_posts_list'><td class='file_link'><a href='" . DROPBOXS_FILE_PATH_VIA_ROOT . $value['post_title'] . "'>" . $value['post_title'] . "</a></td><td class='file_link'><a href='". SITE_URL . "/image/" . $value['post_title'] . "'>" . "link" . "</a></td><td class='delete_link'><a href='/flickrs/kill/file/" . $value['post_id'] . "'><button type='button' class='alert button'><span class='delete_it'>delete</span></button></td></tr>";
          } 
          ?>
				</table>
      </div>
			
		</div>
