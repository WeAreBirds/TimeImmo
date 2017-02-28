<?php get_header(); ?>


<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Actualités</h2>
				<span>Restez au courant des actualités sur Time-Immo</span>
				
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

	<!-- Blog Posts -->
	<div class="blog-page">
	<div class="row">
		<div class="col-md-8">

			
			<?php
			$query = new WP_Query(array('post_type' => 'Blog', 'posts_per_page' => 1));; 
			if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
			?>

			<!-- Blog Post -->
			<div class="blog-post">
				
				<!-- Img -->
				<a href="<?php the_permalink(); ?>" class="post-img">
					<?php the_post_thumbnail( 'full', array( 'class' => 'post-img' ) ); ?>
				</a>
				
				<!-- Content -->
				<div class="post-content">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>

					<ul class="post-meta">
						<li><?php the_time('d-m-y'); ?></li>
						<li><a href="#">5 Comments</a></li>
					</ul>

					<p><?php the_content() ?></p>

					<a href="<?php the_permalink(); ?>" class="read-more">Lire la suite<i class="fa fa-angle-right"></i></a>
				</div>

			</div>
			<!-- Blog Post / End -->

			<?php theme_pagination(); ?>

			<!-- Pagination -->
			<div class="clearfix"></div>
			<div class="pagination-container">
				<nav class="pagination">
					<ul>
						<li><a href="#" class="current-page">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
					</ul>
				</nav>
				
				<nav class="pagination-next-prev">
					<ul>
						<li><a href="<?php next_post_link(); ?>" class="prev">Précédent</a></li>
						<li><a href="<?php next_posts_link(); ?>" class="next">Suivant</a></li>
					</ul>
				</nav>
			</div>
			<div class="clearfix"></div>
			<?php endwhile; endif; ?>
		</div>
<?php theme_pagination(); ?>
	<!-- Widgets -->
	<div class="col-md-4">
		<div class="sidebar right">

			<!-- Widget -->
			<!-- <div class="widget">
				<h3 class="margin-top-0 margin-bottom-25">Search Blog</h3>
				<div class="search-blog-input">
					<div class="input"><input class="search-field" type="text" placeholder="Type and hit enter" value=""/></div>
				</div>
				<div class="clearfix"></div>
			</div> -->
			<!-- Widget / End -->


			<!-- Widget -->
			<div class="widget">
				<h3>Vous avez des questions?</h3>
				<div class="info-box margin-bottom-10">
					<p>N'hésitez pas à nous contactez et nous vous répondrons au plus vite</p>
					<a href="contact.html" class="button fullwidth margin-top-20"><i class="fa fa-envelope-o"></i> Ecrivez-nous</a>
				</div>
			</div>
			<!-- Widget / End -->


			<!-- Widget -->
			<div class="widget">

				<h3>Pages recommandées</h3>
				<ul class="widget-tabs">
					
					<!-- Post popular -->
					<?php
					$query = new WP_Query(array(
						'post_type' => 'Blog', 
						'meta_key'   => '_is_ns_featured_post',
						'meta_value' => 'yes', 
						'posts_per_page' => 3));; 
					if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
					?>
					<li>
						<div class="widget-content">
								<div class="widget-thumb">
								<a href="<?php the_permalink(); ?>" class="">
									<?php the_post_thumbnail( '', array() ); ?>
								</a>
							</div>
							
							<div class="widget-text">
								<h5><a href="<?php the_permalink(); ?>"><?php the_title() ?> </a></h5>
								<span><?php the_time('d-m-y'); ?></span>
							</div>
							<div class="clearfix"></div>
						</div>
					</li>
					<?php endwhile; ?>
					<?php else : ?>
					<?php endif; ?>
					<!-- Fin Post popular -->
				</ul>

			</div>
			<!-- Widget / End-->


			<!-- Widget -->
			<div class="widget">
				<h3 class="margin-top-0 margin-bottom-25">Social</h3>
				<ul class="social-icons rounded">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
				</ul>

			</div>
			<!-- Widget / End-->

			<div class="clearfix"></div>
			<div class="margin-bottom-40"></div>
		</div>
	</div>
	</div>
	<!-- Sidebar / End -->


</div>
</div>


<?php get_footer(); ?>