<?php get_header(); ?>

	<div class="container">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header" style="text-align: center; height: 100px">
					<h1 class="page-title">Oups ! Cette page est introuvable...</h1>
				</header><!-- .page-header -->

				<div class="page-content" style="text-align: center;height: 100px">
					<p>Apparemment, rien n’a été trouvé à cette adresse.</p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- .site-main -->
	</div>

<?php get_footer(); ?>
