		<div class="main col-md-9 col-sm-12 column large-11 small-12" id="user_files_list">
			
		<div class="contactSheetContainer">
  <section class="oneImage">
    <main class="img_holder">
      <a class="img_link" href="https://unsplash.com/photos/aGUndxz-VRw"><img src="https://images.unsplash.com/photo-1464981093170-0a547e55c54c?dpr=1&auto=compress,format&fit=crop&w=2550&h=&q=80&cs=tinysrgb&crop="></img></a>
    </main>
    <aside class="img_caption">
      lamp and stuff
    </aside>
  </section>
  <section class="oneImage">
    <main class="img_holder">
      <a class="img_link" href="https://unsplash.com/photos/iDwGYbnCvss"><img src="https://images.unsplash.com/photo-1501457191481-671f811805de?dpr=1&auto=compress,format&fit=crop&w=1050&h=&q=80&cs=tinysrgb&crop="></img></a>
    </main>
    <aside class="img_caption">
      feet + pineapple
    </aside>
  </section>
  <section class="oneImage">
    <main class="img_holder">
      <a class="img_link" href="https://images.unsplash.com/photo-1506527018297-96e0c1d9654c"><img src="https://images.unsplash.com/photo-1506527018297-96e0c1d9654c"></img></a>
    </main>
    <aside class="img_caption">
      owl
    </aside>
  </section>
  <section class="oneImage">
    <main class="img_holder">
      <a class="img_link" href="https://images.unsplash.com/photo-1505809311222-81989f79ce62"><img src="https://images.unsplash.com/photo-1505809311222-81989f79ce62"></img></a>
    </main>
    <aside class="img_caption">
      canal
    </aside>
  </section>
  <section class="oneImage">
    <main class="img_holder">
      <a class="img_link" href="https://djmblog.com/image/Chillin-on-Greenwood.jpg"><img src="https://djmblog.com/assets/files/Chillin-on-Greenwood.jpg"></img></a>
    </main>
    <aside class="img_caption">
      Chillin on Greenwood
    </aside>
  </section>
  <section class="oneImage">
    <main class="img_holder">
        <a class="img_link" href="https://images.unsplash.com/photo-1506539025711-565f06c5c0d6"><img src="https://images.unsplash.com/photo-1506539025711-565f06c5c0d6"></img></a>
    </main>
    <aside class="img_caption">
      Misty Mountains
    </aside>
  </section>
  <section class="oneImage">
    <main class="img_holder">
      <a class="img_link" href="https://images.unsplash.com/photo-1507313341988-c2e71899a8fd"><img src="https://images.unsplash.com/photo-1507313341988-c2e71899a8fd"></img></a>
    </main>
    <aside class="img_caption">
      Pedestrian
    </aside>
  </section>
  <section class="oneImage">
    <main class="img_holder">
      <a class="img_link" href="https://images.unsplash.com/photo-1506732176389-db44ff3b5c91"><img src="https://images.unsplash.com/photo-1506732176389-db44ff3b5c91"></img></a>
    </main>
    <aside class="img_caption">
      Sprinkler
    </aside>
  </section>
  <section class="oneImage">
    <main class="img_holder">
      <a class="img_link" href="https://djmblog.com/post/47"><img src="https://djmblog.com/assets/files/Apple-Picking3.jpg"></img></a>
    </main>
    <aside class="img_caption">
      Cascades
    </aside>
  </section>
  <section class="oneImage">
    <main class="img_holder">
      <a class="img_link" href="https://images.unsplash.com/photo-1505942793845-9d75f9a22ab0"><img src="https://images.unsplash.com/photo-1505942793845-9d75f9a22ab0"></img></a>
    </main>
    <aside class="img_caption">
      Paddleboarders
    </aside>
  </section>
  <section class="oneImage">
    <main class="img_holder">
      <a class="img_link" href="https://images.unsplash.com/photo-1507829525154-5f81f1d0f2b2"><img src="https://images.unsplash.com/photo-1507829525154-5f81f1d0f2b2"></img></a>
    </main>
    <aside class="img_caption">
      Oceanliners
    </aside>
  </section>
  <section class="oneImage">
    <main class="img_holder">
      <a class="img_link" href="https://djmblog.com/post/43"><img src="https://djmblog.com/assets/images/tulips-field-angle1-2016-by-DanMcKeown.jpg"></img></a>
    </main>
    <aside class="img_caption">
      Tulips
    </aside>
  </section>
</div>

			<h2><?= $title ?></h2>
			<p>
				<? 	
				$posts_latest_first = $posts;
				?><table class="table hover stack"><thead><tr><td>file name</td><td>photo page</td><td>action</td></thead><tbody><?
					foreach ($posts_latest_first as $key => $value) {
						echo "<tr class='blog_posts_list'><td class='file_link'><a href='" . DROPBOXS_FILE_PATH_VIA_ROOT . $value['post_title'] . "'>" . $value['post_title'] . "</a></td><td class='file_link'><a href='". SITE_URL . "/image/" . $value['post_title'] . "'>" . "link" . "</a></td><td class='delete_link'><a href='/flickrs/kill/file/" . $value['post_id'] . "'><button type='button' class='alert button'><span class='delete_it'>delete</span></button></td></tr>";
					} ?>
				</table>
			</p>
			
		</div>
