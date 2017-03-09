<?php get_header(); ?>

<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Nos dossiers</h2>
				<span>Nous avons enquêté pour vous !</span>
				
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


		<!-- Post Content -->
		<div class="col-md-8">
			
			<!-- BOUCLE -->
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
			<!-- Blog Post -->
			<div class="blog-post single-post">
				
				<!-- Img -->
				<?php the_post_thumbnail( 'full', array( 'class' => 'post-img' ) ); ?>

				
				<!-- Content -->
				<div class="post-content">
					<h3><?php the_title() ?></h3>

					<ul class="post-meta">
						<li><?php the_date('d-m') ?></li>
						<!-- <li><a href="#">5 Comments</a></li> -->
					</ul>

					<?php the_content() ?>


					<!-- Share Buttons -->
					<!-- <ul class="share-buttons margin-top-40 margin-bottom-0">
						<li><a class="fb-share" href="#"><i class="fa fa-facebook"></i> Share</a></li>
						<li><a class="twitter-share" href="#"><i class="fa fa-twitter"></i> Tweet</a></li>
						<li><a class="gplus-share" href="#"><i class="fa fa-google-plus"></i> Share</a></li>
						<li><a class="pinterest-share" href="#"><i class="fa fa-pinterest-p"></i> Pin</a></li>
					</ul> -->
					<div class="clearfix"></div>

				</div>
			</div>
			<!-- Blog Post / End -->

			<?php endwhile; ?>
			<?php else : ?>
			<?php endif; ?>


			<!-- Post Navigation -->
			<!-- <ul id="posts-nav" class="margin-top-0 margin-bottom-40">
				<li class="next-post">
					<a href="#"><span>Next Post</span>
					Tips For Newbie Hitchhiker</a>
				</li>
				<li class="prev-post">
					<a href="#"><span>Previous Post</span>
					What's So Great About Merry?</a>
				</li>
			</ul> -->


			<!-- About Author -->
			<!-- <div class="about-author">
				<img src="images/agent-avatar.jpg" alt="" />
				<div class="about-description">
					<h4>Jennie Wilson</h4>
					<a href="#">jennie@example.com</a>
					<p>Nullam ultricies, velit ut varius molestie, ante metus condimentum nisi, dignissim facilisis turpis ex in libero. Sed porta ante tortor, a pulvinar mi facilisis nec. Proin finibus dolor ac convallis congue.</p>
				</div>
			</div> -->


			<!-- Related Posts -->
			
			<!-- Related Posts / End -->
			
	</div>
	<!-- Content / End -->


	<!-- Sidebar
	================================================== -->

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
					<p>N'hésitez pas à nous contacter et nous vous répondrons au plus vite</p>
					<a href="../../contact" class="button fullwidth margin-top-20"><i class="fa fa-envelope-o"></i> Écrivez-nous</a>
				</div>
			</div>
			<!-- Widget / End -->


			<!-- Widget -->
			<div class="widget">

				<h3>Autres dossiers</h3>
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
			<!-- <div class="widget">
				<h3 class="margin-top-0 margin-bottom-25">Social</h3>
				<ul class="social-icons rounded">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
				</ul>

			</div> -->
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