<?php get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<?php
			// Démarrage du Loop
			while ( have_posts() ) : the_post();
				
				
				
			endwhile;
		?>
		
	</div><!-- #content -->
</div><!-- #primary -->
    
<?php get_footer();
