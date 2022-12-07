<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>

	<body id="top" <?php body_class(); ?>>

		<header id="site-header" class="site-header">

			<nav class="navbar" role="navigation">
  				<div class="navbar-container">

    				<!-- Burger -->
    				<!--<div class="navbar-header container">

						<a href="<?php echo get_site_url();?>">
							<div class="navbar-logo">
								<img src="<?php echo get_template_directory_uri(); ?>/images/svg/flowbox-logo.svg" alt="" class="navbar-logo__img">
							</div>
						</a>
      					<button type="button" class="navbar-toggle">
        					<span class="icon-bar"></span>
        					<span class="icon-bar"></span>
        					<span class="icon-bar"></span>
      					</button>

    				</div>-->

    			


				<!-- Menu-->
				<?php
					wp_nav_menu( array(
						'theme_location'    => 'primary',
						'depth'             => 2,
						'container'         => 'div',
						'container_class'   => 'collapse',
						'menu_class'        => 'nav navbar-nav'
					));
				?>
				</div>

			</nav>




		</header>
		
		<div id="main" class="site-main">