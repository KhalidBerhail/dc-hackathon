<?php get_header(); ?> 

<?php
    global $wp_query;
    $total_results = $wp_query->found_posts;
    $plural = $total_results > 1 ? 's' : '';

    /**
     * Give post type, change text if needed (based on webdesign)
     * @param String
     * @return String
     */
    function get_post_type_formated( $the_post_type ){
        $formated = $the_post_type; // By default
        $lang_current = apply_filters( 'wpml_current_language', NULL ); // en | fr

        if ( $lang_current == 'fr' ) {

            switch ($the_post_type) {
                case 'faq':
                    $formated = __("FAQ", "devhackathon");
                    break;
    
                case 'post':
                    $formated = __("Journal de bord", "devhackathon");
                    break;
            }

        } elseif ( $lang_current == 'en' ) {
            switch ($the_post_type) {
                case 'presse':
                    $formated = __("Presse", "devhackathon"); // EN Translated in WPML
                    break;
    
                case 'emploi':
                    $formated = __("Offre d'emploi", "devhackathon"); // EN Translated in WPML
                    break;
            }
        }

        return $formated;
    }
?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">


        <div class="post-single search-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-lg-8">
                        

                        <!-- Search form section -->
                        <h1 class="search-section__title"><?php _e("Recherche", "devhackathon"); ?></h1>

                        <div class="search-section__form">
                            <?php get_search_form(); ?>

                            <!-- Search btn like navbar search toggle -->
                            <button class="navbar-search-btn js-toggle-search">
                                <!-- <img src="<?php // echo get_template_directory_uri(); ?>/images/svg/icon-search.svg" alt="" class="navbar-search-btn__img img-responsive" loading="lazy"> -->
                                <svg width="48" height="49" viewBox="0 0 48 49" fill="none" xmlns="http://www.w3.org/2000/svg" class="navbar-search-btn__img img-responsive">
                                    <path d="M31 28.5184H29.42L28.86 27.9784C30.82 25.6984 32 22.7384 32 19.5184C32 12.3384 26.18 6.51843 19 6.51843C11.82 6.51843 6 12.3384 6 19.5184C6 26.6984 11.82 32.5184 19 32.5184C22.22 32.5184 25.18 31.3384 27.46 29.3784L28 29.9384V31.5184L38 41.4984L40.98 38.5184L31 28.5184V28.5184ZM19 28.5184C14.02 28.5184 10 24.4984 10 19.5184C10 14.5384 14.02 10.5184 19 10.5184C23.98 10.5184 28 14.5384 28 19.5184C28 24.4984 23.98 28.5184 19 28.5184Z" fill="#40403B"/>
                                </svg>
                            </button>
                        </div>
                        <p class="search-section__total"><?php echo $total_results . ' ' . __('résultat', 'devhackathon') . $plural; ?></p>

                        <!-- Results -->
                        <ul class="search-section__list" data-aos="fade-right">

                            <?php if ( have_posts() ) : ?>
                                
                                <?php while ( have_posts() ) : the_post(); ?>
                                    <li class="search-section-item">
                                        <div class="search-section-item__type"><?php echo get_post_type_formated( get_post_type() ); ?></div>
                                        <div class="search-section-item__content">
                                            <h2 class="search-section-item__title">
                                                <a href="<?php the_permalink(); ?>" class="search-section-item__title-link"><?php the_title(); ?></a>
                                            </h2>
                                            <div class="search-section-item__btn-container">
                                                <a href="<?php the_permalink(); ?>" class="btn-outline-gradient--white" target="_blank">
                                                    <span class="btn-copy"><?php _e("Lire l'article", "devhackathon"); ?></span>
                                                    <span class="btn-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/svg/icon-arrow-white.svg" alt="" class="img-responsive" loading="lazy"></span>
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </li>                                
                                <?php endwhile; ?>
                                
                            <?php endif; ?>

                        </ul>

                    </div>
                </div>            
            </div>

            <?php 
                // Pagination
                the_posts_pagination( array(
                    'prev_text' => '<span class="icon-chevron--prev"><img src="' . get_template_directory_uri() . '/images/svg/icon-chevron-down--600.svg" alt="" class="img-responsive" loading="lazy"></span>',
                    'next_text' => '<span class="icon-chevron--next"><img src="' . get_template_directory_uri() . '/images/svg/icon-chevron-down--600.svg" alt="" class="img-responsive" loading="lazy"></span>',
                    'mid_size'  => 2,
                ) );
            ?>

        </div>


	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer();
