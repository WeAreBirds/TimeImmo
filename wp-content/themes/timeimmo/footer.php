<!-- Footer
================================================== -->
<div id="footer" class="sticky-footer">
	<!-- Main -->
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-sm-6">
				<img class="footer-logo" src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="">
				<br><br>
				<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer_text') ) ?>
			</div>

			<div class="col-md-1 col-sm-0 "></div>

			<div class="col-md-3 col-sm-6 ">

				<h4>Liens</h4>
				<?php wp_nav_menu( array( 'Navigation principale' => 'Top', 'menu_class' => 'footer-links' ) ); ?>
				<div class="clearfix"></div>
			</div>		

			<div class="col-md-3  col-sm-12">
				<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer_contact') ) ?>

				<ul class="social-icons margin-top-20">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="vimeo" href="#"><i class="icon-vimeo"></i></a></li>
				</ul>

			</div>

		</div>
		
		<!-- Copyright -->
		<div class="row">
			<div class="col-md-12">
				<div class="copyrights">© 2017 We Are Birds. Tous droits réservés.</div>
			</div>
		</div>

	</div>

</div>
<!-- Footer / End -->


<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>


<!-- Scripts
================================================== -->
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/chosen.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/rangeSlider.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/sticky-kit.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/slick.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/jquery.jpanelmenu.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/tooltips.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/masonry.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/custom.js"></script>

<!-- Maps -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/infobox.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/markerclusterer.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/maps.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/gmaps.js"></script>


</div>
<!-- Wrapper / End -->

<?php wp_footer() ?>
</body>
</html>