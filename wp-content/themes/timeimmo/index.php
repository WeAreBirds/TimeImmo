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
							<select data-placeholder="Any Type" class="chosen-select-no-single" >
								<option>Apartments</option>
								<option>Houses</option>
								<option>Commercial</option>
								<option>Garages</option>
								<option>Lots</option>
							</select>
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
						Recherche approfondie <a href="listings-list-full-width.html">Recherche avancée</a>
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
				<div class="carousel-item">
					<div class="listing-item compact">

						<a href="single-property-page-1.html" class="listing-img-container">

							<div class="listing-badges">
								<span class="featured">Featured</span>
								<span>For Sale</span>
							</div>

							<div class="listing-img-content">
								<span class="listing-compact-title">Eagle Apartments <i>$275,000</i></span>

								<ul class="listing-hidden-content">
									<li>Area <span>530 sq ft</span></li>
									<li>Rooms <span>3</span></li>
									<li>Beds <span>1</span></li>
									<li>Baths <span>1</span></li>
								</ul>
							</div>

							<img src="<?php bloginfo('template_directory'); ?>/images/listing-01.jpg" alt="">
						</a>

					</div>
				</div>
				<!-- Listing Item / End -->

				<!-- Listing Item -->
				<div class="carousel-item">
					<div class="listing-item compact">

						<a href="single-property-page-2.html" class="listing-img-container">

							<div class="listing-badges">
								<span class="featured">Featured</span>
								<span>For Sale</span>
							</div>

							<div class="listing-img-content">
								<span class="listing-compact-title">Serene Uptown <i>$900 / monthly</i></span>

								<ul class="listing-hidden-content">
									<li>Area <span>440 sq ft</span></li>
									<li>Rooms <span>3</span></li>
									<li>Beds <span>1</span></li>
									<li>Baths <span>1</span></li>
								</ul>
							</div>

							<img src="<?php bloginfo('template_directory'); ?>/images/listing-02.jpg" alt="">
						</a>

					</div>
				</div>
				<!-- Listing Item / End -->

				<!-- Listing Item -->
				<div class="carousel-item">
					<div class="listing-item compact">

						<a href="single-property-page-1.html" class="listing-img-container">

							<div class="listing-badges">
								<span class="featured">Featured</span>
								<span>For Rent</span>
							</div>

							<div class="listing-img-content">
								<span class="listing-compact-title">Meridian Villas <i>$1700 / monthly</i></span>

								<ul class="listing-hidden-content">
									<li>Area <span>1450 sq ft</span></li>
									<li>Rooms <span>3</span></li>
									<li>Beds <span>2</span></li>
									<li>Baths <span>2</span></li>
								</ul>
							</div>

							<img src="<?php bloginfo('template_directory'); ?>/images/listing-03.jpg" alt="">
						</a>

					</div>
				</div>
				<!-- Listing Item / End -->

				<!-- Listing Item -->
				<div class="carousel-item">
					<div class="listing-item compact">

						<a href="single-property-page-3.html" class="listing-img-container">

							<div class="listing-badges">
								<span class="featured">Featured</span>
								<span>For Sale</span>
							</div>

							<div class="listing-img-content">
								<span class="listing-compact-title">Selway Apartments <i>$420,000</i></span>

								<ul class="listing-hidden-content">
									<li>Area <span>540 sq ft</span></li>
									<li>Rooms <span>2</span></li>
									<li>Beds <span>2</span></li>
									<li>Baths <span>1</span></li>
								</ul>
							</div>

							<img src="<?php bloginfo('template_directory'); ?>/images/listing-04.jpg" alt="">
						</a>

					</div>
				</div>
				<!-- Listing Item / End -->

				<!-- Listing Item -->
				<div class="carousel-item">
					<div class="listing-item compact">

						<a href="single-property-page-2.html" class="listing-img-container">

							<div class="listing-badges">
								<span class="featured">Featured</span>
								<span>For Sale</span>
							</div>

							<div class="listing-img-content">
								<span class="listing-compact-title">Oak Tree Villas <i>$535,000</i></span>

								<ul class="listing-hidden-content">
									<li>Area <span>550 sq ft</span></li>
									<li>Rooms <span>3</span></li>
									<li>Beds <span>2</span></li>
									<li>Baths <span>2</span></li>
								</ul>
							</div>

							<img src="<?php bloginfo('template_directory'); ?>/images/listing-05.jpg" alt="">
						</a>

					</div>
				</div>
				<!-- Listing Item / End -->

				<!-- Listing Item -->
				<div class="carousel-item">
					<div class="listing-item compact">

						<a href="single-property-page-1.html" class="listing-img-container">

							<div class="listing-badges">
								<span class="featured">Featured</span>
								<span>For Rent</span>
							</div>

							<div class="listing-img-content">
								<span class="listing-compact-title">Old Town Manchester <i>$500 / monthly</i></span>

								<ul class="listing-hidden-content">
									<li>Area <span>850 sq ft</span></li>
									<li>Rooms <span>3</span></li>
									<li>Beds <span>2</span></li>
									<li>Baths <span>1</span></li>
								</ul>
							</div>

							<img src="<?php bloginfo('template_directory'); ?>/images/listing-06.jpg" alt="">
						</a>

					</div>
				</div>
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
					<a href="listings-list-with-sidebar.html" class="button margin-top-25">Get Started</a>
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
	<h3 class="headline-box">Articles & Tips</h3>

	<div class="container">
		<div class="row">

			<div class="col-md-4">

				<!-- Blog Post -->
				<div class="blog-post">
					
					<!-- Img -->
					<a href="blog-post.html" class="post-img">
						<img src="<?php bloginfo('template_directory'); ?>/images/blog-post-01.jpg" alt="">
					</a>
					
					<!-- Content -->
					<div class="post-content">
						<h3><a href="#">8 Tips to Help You Finding New Home</a></h3>
						<p>Nam nisl lacus, dignissim ac tristique ut, scelerisque eu massa. Vestibulum ligula nunc, rutrum in malesuada vitae. </p>

						<a href="blog-post.html" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
					</div>

				</div>
				<!-- Blog Post / End -->

			</div>

			<div class="col-md-4">

				<!-- Blog Post -->
				<div class="blog-post">
					
					<!-- Img -->
					<a href="blog-post.html" class="post-img">
						<img src="<?php bloginfo('template_directory'); ?>/images/blog-post-02.jpg" alt="">
					</a>
					
					<!-- Content -->
					<div class="post-content">
						<h3><a href="#">Bedroom Colors You'll Never Regret</a></h3>
						<p>Nam nisl lacus, dignissim ac tristique ut, scelerisque eu massa. Vestibulum ligula nunc, rutrum in malesuada vitae. </p>

						<a href="blog-post.html" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
					</div>

				</div>
				<!-- Blog Post / End -->

			</div>

			<div class="col-md-4">

				<!-- Blog Post -->
				<div class="blog-post">
					
					<!-- Img -->
					<a href="blog-post.html" class="post-img">
						<img src="<?php bloginfo('template_directory'); ?>/images/blog-post-03.jpg" alt="">
					</a>
					
					<!-- Content -->
					<div class="post-content">
						<h3><a href="#">What to Do a Year Before Buying Apartment</a></h3>
						<p>Nam nisl lacus, dignissim ac tristique ut, scelerisque eu massa. Vestibulum ligula nunc, rutrum in malesuada vitae. </p>

						<a href="blog-post.html" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
					</div>

				</div>
				<!-- Blog Post / End -->

			</div>

		</div>
	</div>
</section>
<!-- Fullwidth Section / End -->


<!-- Flip banner -->
<a href="listings-half-map-grid-standard.html" class="flip-banner parallax" data-background="<?php bloginfo('template_directory'); ?>/images/flip-banner-bg.jpg" data-color="#274abb" data-color-opacity="0.9" data-img-width="2500" data-img-height="1600">
	<div class="flip-banner-content">
		<h2 class="flip-visible">We help people and homes find each other</h2>
		<h2 class="flip-hidden">Browse Properties <i class="sl sl-icon-arrow-right"></i></h2>
	</div>
</a>
<!-- Flip banner / End -->


<?php get_footer(); ?>