

<?php get_header(); ?>
	test
	<div class="container">
		<?php echo do_shortcode('[wpdreams_asp_settings id=2 element="div"]'); ?>
<?php echo do_shortcode('[wpdreams_ajaxsearchpro_results id=2 element="div"]'); ?>
		<?php the_content(); ?>
	</div>

<?php get_footer(); ?>