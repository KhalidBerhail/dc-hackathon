<?php
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".get_bloginfo('url'));
	exit();
	// ** Redirect all 404 pages to HomePage (demande du client) **
?>


<?php get_header(); ?>


<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<section class="section-404">
		</section>

	</div><!-- #content -->
</div><!-- #primary -->
    

<?php get_footer();
