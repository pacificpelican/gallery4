		<footer class="footer col-md-12 col-sm-12 medium-12 small-12 columns" id="bottom_footer">
			<br />
			<p>
				<? 	if (isset($footerBrand))
					{
						echo "$footerBrand";
					}
					else
					{
						echo "<a href='" . FOOTER_URL ."' class='button off_white_button btn btn-secondary'>" . FOOTER_TEXT . "</a>";
					}
				?>
			</p>
		</footer>
	</div>
</body>
</html>
