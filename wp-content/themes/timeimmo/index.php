<?php get_header(); ?>


<!-- Banner
================================================== -->
<div class="parallax" data-background="<?php bloginfo('template_directory'); ?>/images/home-parallax-2.jpg" data-color="#36383e" data-color-opacity="0.5" data-img-width="2500" data-img-height="1600">

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				
				<div class="search-container">

					<!-- Form -->
					<h2>Trouvez la maison de vos rêves</h2>

					<!-- Row With Forms -->
					<div class="row with-forms">
						
						<!-- Property Type -->
						<div class="col-md-3">
							<?php echo do_shortcode('[wpdreams_ajaxsearchpro_results id=2 element="div"]'); ?>
						</div>

						<!-- Status -->
						<div class="col-md-3">
							<select data-placeholder="Any Status" class="chosen-select-no-single" >	
								<option>For Sale</option>
								<option>For Rent</option>
							</select>
						</div>

						<!-- Main Search Input -->
						<div class="col-md-6">
							<div class="main-search-input">
								<input type="text" placeholder="Enter address e.g. street, city or state" value=""/>
								<button class="button"><i class="fa fa-search"></i></button>
							</div>
						</div>

					</div>
					<!-- Row With Forms / End -->

					<!-- Browse Jobs -->
					<div class="adv-search-btn">
						Recherche approfondie <a href="<?php echo get_page_link(59); ?>">Recherche avancée</a>
					</div>
					
					<!-- Announce -->
					<div class="announce">
						Nous sommes à votre écoute!
					</div>

				</div>

			</div>
		</div>
	</div>

</div>

		
<!-- Content
================================================== -->
<!-- Fullwidth Section -->
<section class="fullwidth border-bottom margin-top-0 margin-bottom-0 padding-top-50 padding-bottom-50" data-background-color="#ffffff">

	<!-- Content -->
	<div class="container">
		<div class="row">

			<div class="col-md-4">
				<!-- Icon Box -->
				<div class="icon-box-1 alternative">

					<div class="icon-container">
						<i class="im im-icon-Checked-User"></i>
					</div>
					<?php 
			            $id = 26;
			            $banner= get_post($id);
			            $contenu = $banner->post_content;
			            $titre = $banner->post_title;
			        ?>
					<h3><?php echo $titre ?></h3>
					<p><?php echo $contenu ?></p>

				</div>
			</div>

			<div class="col-md-4">
				<!-- Icon Box -->
				<div class="icon-box-1 alternative">

					<div class="icon-container">
						<i class="im im-icon-Cloud-Computer"></i>
					</div>

					<?php 
			            $id = 28;
			            $banner= get_post($id);
			            $contenu = $banner->post_content;
			            $titre = $banner->post_title;
			        ?>
					<h3><?php echo $titre ?></h3>
					<p><?php echo $contenu ?></p>

				</div>
			</div>

			<div class="col-md-4">
				<!-- Icon Box -->
				<div class="icon-box-1 alternative">

					<div class="icon-container">
						<i class="im im-icon-Idea"></i>
					</div>

					<?php 
			            $id = 31;
			            $banner= get_post($id);
			            $contenu = $banner->post_content;
			            $titre = $banner->post_title;
			        ?>
					<h3><?php echo $titre ?></h3>
					<p><?php echo $contenu ?></p>

				</div>
			</div>

		</div>
	</div>

</section>
<!-- Fullwidth Section / End -->


<!-- Featured -->
<div class="container">
	<div class="row">
	
		<div class="col-md-12">
			<h3 class="headline margin-bottom-25 margin-top-65">Les dernières offres</h3>
		</div>
		
		<!-- Carousel -->
		<div class="col-md-12">
			<div class="carousel">	

				<!-- Listing Item -->
				<?php
				$query = new WP_Query(array(
					'post_type' => 'Liste', 
					'posts_per_page' => 6)); 
				if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
				?>
				<div class="carousel-item">
					<div class="listing-item compact">

						<a href="<?php the_permalink(); ?>" class="listing-img-container">

							<div class="listing-badges">
								<span class="featured">coup de coeur</span>
								<span><?php the_field('status_du_bien'); ?></span>
							</div>

							<div class="listing-img-content">
								<span class="listing-compact-title"><?php the_title( ); ?> <i><?php the_field('prix'); ?></i></span>

								<ul class="listing-hidden-content">
									<li><?php the_field('surface'); ?></li>
									<li><?php the_field('chambre'); ?></li>
									<li><?php the_field('salle_de_bain'); ?></li>
									<li><?php the_field('choix'); ?></li>
								</ul>
							</div>

							<?php $image = get_field('large_image_list');
							if( !empty($image) ): ?>
								<img src="<?php echo $image['url']; ?>" alt="">
							<?php endif; ?>
						</a>

					</div>
				</div>
				<?php endwhile; ?>
				<?php else : ?>
				<?php endif; ?>
				<!-- Listing Item / End -->

			</div>
		</div>
		<!-- Carousel / End -->

	</div>
</div>
<!-- Featured / End -->



<!-- Fullwidth Section -->
<section class="fullwidth margin-top-105 margin-bottom-0 padding-bottom-80 padding-top-95" data-background-color="#f7f7f7">

	<!-- Box Headline -->
	<h3 class="headline-box">Ce que les clients pensent de <br>Time Immo</h3>
	
	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<div class="testimonials-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque consectetur odio a bibendum sollicitudin.</div>
			</div>
			
			<!-- BOUCLE -->
			<?php
			$query = new WP_Query(array('post_type' => 'Avis client', 'posts_per_page' => 3));; 
			if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
			?>

			<div class="col-md-4">
				<div class="testimonial-box">
					<div class="testimonial"><?php the_content(); ?></div>
					<div class="testimonial-author">

					<?php $image = get_field('image_du_client');
					if( !empty($image) ): ?>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
					<?php endif; ?>

						<h4><?php the_title(); ?><span><?php the_field('fonction_du_client'); ?></span></h4>
					</div>
				</div>
			</div>
			
			<!-- FIN BOUCLE -->
			<?php endwhile; endif; ?>

		</div>
	</div>

</section>
<!-- Fullwidth Section / End -->



<!-- Parallax -->
<div class="parallax margin-bottom-70"
	data-background="<?php bloginfo('template_directory'); ?>/images/listings-parallax.jpg"
	data-color="#36383e"
	data-color-opacity="0.7"
	data-img-width="800"
	data-img-height="505">

	<!-- Infobox -->
	<div class="text-content white-font">
		<div class="container">

			<div class="row">
				<div class="col-lg-6 col-sm-8">
					<h2>It's your journey. We're here to help.</h2>
					<p>We’re full-service, local agents who know how to find people and home each together. We use online tools with an unmatched search capability to make you smarter and faster.</p>
					<a href="<?php echo get_page_link(59); ?>" class="button margin-top-25">C'est partit !</a>
				</div>
			</div>

		</div>
	</div>

	<!-- Infobox / End -->

</div>
<!-- Parallax / End -->


<!-- Fullwidth Section -->
<section class="fullwidth margin-top-95 margin-bottom-0">

	<!-- Box Headline -->
	<h3 class="headline-box">Articles & actualités</h3>

	<div class="container">
		<div class="row">
			
		<?php
		$query = new WP_Query(array('post_type' => 'Blog', 'posts_per_page' => 3));; 
		if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
		?>
			
			<div class="col-md-4">
			
				<!-- Blog Post -->
				<div class="blog-post">
					
					<!-- Img -->
					<a href="<?php the_permalink(); ?>" class="post-img">
					<?php $image = get_field('blog_image');
						if( !empty($image) ): ?>
							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<?php endif; ?>
					</a>
					
					<!-- Content -->
					<div class="post-content">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
						<p><?php the_field('extrait'); ?></p>

						<a href="<?php the_permalink(); ?>" class="read-more">Lire la suite <i class="fa fa-angle-right"></i></a>
					</div>

				</div>
				<!-- Blog Post / End -->

			</div>
		<?php endwhile; endif; ?>

		</div>
	</div>
</section>
<!-- Fullwidth Section / End -->


<!-- Flip banner -->
<a href="<?php echo get_page_link(59); ?>" class="flip-banner parallax" data-background="<?php bloginfo('template_directory'); ?>/images/flip-banner-bg.jpg" data-color="#274abb" data-color-opacity="0.9" data-img-width="2500" data-img-height="1600">
	<div class="flip-banner-content">
		<h2 class="flip-visible">Nous aidons les gens et les biens à se trouver</h2>
		<h2 class="flip-hidden">Voir les propriétés <i class="sl sl-icon-arrow-right"></i></h2>
	</div>
</a>
<!-- Flip banner / End -->


<?php get_footer(); ?>