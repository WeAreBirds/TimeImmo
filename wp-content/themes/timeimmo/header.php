<!DOCTYPE html>
<head>

<!-- Basic Page Needs
================================================== -->
<title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/colors/main.css" id="colors">
<?php wp_head(); ?>
</head>

<body>

<!-- Wrapper -->
<div id="wrapper">


<!-- Header Container
================================================== -->
<header id="header-container" class="header-style-2">

	<!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo" class="margin-top-10">
					<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt=""></a>

					<!-- Logo for Sticky Header -->
					<a href="<?php bloginfo('url'); ?>" class="sticky-logo"><img src="<?php bloginfo('template_directory'); ?>/images/logo_TimeImmo_Black.png" alt=""></a>
				</div>
				
			</div>
			<!-- Left Side Content / End -->

			<!-- Right Side Content / End -->
			<div class="right-side">
				<ul class="header-widget">
					<li>
						<i class="sl sl-icon-call-in"></i>
						<div class="widget-content">
							<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('menu haut telephone') ) ?>
						</div>
					</li>

					<li>
						<i class="sl sl-icon-location"></i>
						<div class="widget-content">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('menu haut adresse') ) ?>
						</div>
					</li>

					<li class="with-btn"><a href="<?php echo get_page_link(15); ?>" class="button border">Proposer un bien</a></li>
				</ul>
			</div>
			<!-- Right Side Content / End -->

		</div>


		<!-- Mobile Navigation -->
		<div class="menu-responsive">
			<i class="fa fa-reorder menu-trigger"></i>
		</div>


		<!-- Main Navigation -->
		<nav id="navigation" class="style-2">
			<div class="container">
				<?php wp_nav_menu( array( 'Navigation principale' => 'Top', 'menu_id' => 'responsive' ) ); ?>
			</div>
		</nav>
		<div class="clearfix"></div>
		<!-- Main Navigation / End -->
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->