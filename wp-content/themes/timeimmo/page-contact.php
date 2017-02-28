<?php get_header(); ?>


<!-- Content
================================================== -->

<!-- Map Container -->
<div class="contact-map margin-bottom-55">

	<!-- Google Maps -->
	<div class="google-map-container">
		<div id="propertyMap" data-latitude="40.7427837" data-longitude="-73.11445617675781"></div>
		<a href="#" id="streetView">Street View</a>
	</div>
	<!-- Google Maps / End -->

	<!-- Office -->
	<div class="address-box-container">
		<div class="address-container" data-background-image="<?php bloginfo('template_directory'); ?>/images/contact-image.jpg">
			<div class="office-address">
				<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('page_contact_adresse') ) ?>
			</div>
		</div>
	</div>
	<!-- Office / End -->

</div>
<div class="clearfix"></div>
<!-- Map Container / End -->


<!-- Container / Start -->
<div class="container">

	<div class="row">

		<!-- Contact Details -->
		<div class="col-md-4">
			<!-- widget -->
			<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('page_contact_infos') ) ?>
		</div>

		<!-- Contact Form -->
		<div class="col-md-8">

			<section id="contact">
				<h4 class="headline margin-bottom-35">Formulaire de contact</h4>

				<div id="contact-message"></div> 
					<?php echo do_shortcode('[contact-form-7 id="86" title="page contact"]'); ?>		
			</section>
		</div>
		<!-- Contact Form / End -->

	</div>

</div>
<!-- Container / End -->



<?php get_footer(); ?>