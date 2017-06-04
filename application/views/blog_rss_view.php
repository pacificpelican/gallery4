<? echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"; ?>
<rss version="2.0">
	<channel><!-- RSS 2.0 feed for <?= SITE_URL ?> -->
		<title><?= $title ?></title>
			<link><?= SITE_URL ?></link>
				<description><?= BLOG_DESCRIPTION ?></description>
					<language>en-us</language>
						<? 	
					foreach ($posts as $key => $value) {
						echo "<item><title>" . $value['post_title'] . "</title>";
						echo "<description>" . $value['post'] . "</description><pubDate>" . $value['updated_at']. " UTC</pubDate>";
						if ((isset($value['podcastPayload'])) && ($value['podcastPayload'] != null))
						{
							echo "<enclosure url='" . $value['podcastPayload'] . "' />";
						//	echo "<media:content url='http://pacificpelican.us/64/uploads/pacificpelican64Podcast128March2014.m4a' type='audio/mpeg' />;
						}
						echo "<link>" . SITE_URL . "/post/" . $value['post_id'] . "</link></item>";	
					} ?>
	</channel>
</rss>