<?php get_header(); ?> 

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

	<?php
		if ( have_posts() ) :

		
			
		else :

			
		endif;
	?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer();
