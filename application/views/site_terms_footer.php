
		<footer class="footer col-md-12 col-sm-12 medium-12 small-12 columns" id="bottom_footer">
			<br />
			<p>
				<a href='/terms' class='btn btn-info'><button class="button hollow">Terms and Conditions</button></a>
			</p>
			<p>
				<a href='/privacy' class='btn btn-info button hollow'>Privacy Policy</a>
			</p>
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