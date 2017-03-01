<?php get_header(); ?>


<!-- Content
================================================== -->

<!-- Map Container -->
<div class="contact-map margin-bottom-55">

	<!-- Google Maps -->
	<div class="google-map-container">
		<div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10163.014209936946!2d3.960943302432298!3d50.44569097017021!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c24558a6578cfb%3A0x40099ab2f4d6c90!2sMons!5e0!3m2!1sfr!2sbe!4v1488409424017" width="100%" height="420" frameborder="0" style="border:0; pointer-events: none;" allowfullscreen></iframe></div>
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