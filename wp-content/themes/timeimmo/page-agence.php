<?php get_header(); ?>


<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<?php
				$query = new WP_Query(array('post_type' => 'Agent', 'posts_per_page' => 6));; 
				if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
				?>

				<h2><?php the_title(); ?></h2>
				<span><?php the_field('bottom_name'); ?></span>

				<?php endwhile; endif; ?>
				
				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<?php if ( function_exists('yoast_breadcrumb') ) 
					{yoast_breadcrumb('<ul><li><span>','</span></li></ul>');} ?>
				</nav>

			</div>
		</div>
	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<div class="row">

		<div class="col-md-12">
			<div class="agent agent-page">

				<?php
				$query = new WP_Query(array('post_type' => 'Agent', 'posts_per_page' => 6));; 
				if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
				?>

				<div class="agent-avatar">
					<?php $image = get_field('agent_image');
					if( !empty($image) ): ?>
						<img src="<?php echo $image['url']; ?>" alt="">
					<?php endif; ?>
				</div>

				<div class="agent-content">
					<div class="agent-name">
						<h4><?php the_title(); ?></h4>
						<span><?php the_field('bottom_name'); ?></span>
					</div>

					<p><?php the_content(); ?></p>

					<ul class="agent-contact-details">
						<li><i class="sl sl-icon-call-in"></i><?php the_field('phone'); ?></li>
						<li><i class="fa fa-envelope-o "></i><a href="mailto:<?php the_field('mail'); ?>"><?php the_field('mail'); ?></a></li>
					</ul>

					<ul class="social-icons">
						<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
						<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
						<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
						<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>

				<?php endwhile; endif; ?>

			</div>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<!--  -->


<?php get_footer(); ?>