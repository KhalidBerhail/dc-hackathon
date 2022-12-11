<?php
/* -------------------------------------------------------------------------------------*/
/* Configuration de base du theme */
/* -------------------------------------------------------------------------------------*/
if ( ! function_exists( 'devhackathon_setup' ) ) :
    function devhackathon_setup() {
      add_theme_support( 'automatic-feed-links' );
      add_theme_support( 'title-tag' );
      add_theme_support( 'post-thumbnails' );

      // MENU
      register_nav_menus( array(
            'primary' => __( 'Menu entete', 'Menu header' ),
      ) );
      register_nav_menus( array(
            'footer' => __( 'Menu pied de page', 'Menu footer' ),
      ) );
  }
endif;
add_action( 'after_setup_theme', 'devhackathon_setup' );


/* -------------------------------------------------------------------------------------*/
/* On déclare les scripts et feuilles de style à utiliser en front  */
/* -------------------------------------------------------------------------------------*/
function devhackathon_scripts() {
  // Google Font
  wp_enqueue_style( 'googlefont' ,'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap');
  // AnimateOnScroll 
  //wp_enqueue_style( 'aos-css' ,'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css', array(), '2.3.4');
  // Theme stylesheet.
  wp_enqueue_style( 'style-css', get_template_directory_uri() . '/css/style.css', array(), filemtime(get_template_directory() . '/css/style.css') );
  
  //FontAwesome
  wp_enqueue_style( 'FontAwesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css", array(), '6.2.1');
  
  // Jquery 
  wp_enqueue_script( 'jquery-core' );
  // AnimateOnScroll JS
  //wp_enqueue_script( 'aos-js', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js', array( 'jquery-core' ), '2.3.4', true );
  // Si besoin, on appelle functions.js en footer pour des fonctions en JS ou Jquery spécifiques
  wp_enqueue_script( 'functions-js', get_template_directory_uri() . '/js/functions.js', array(), filemtime(get_template_directory() . '/js/functions.js'), true );

  /*---Animation scripts---*/
  //Gsap
  wp_enqueue_script( 'Gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js', array(), '3.11.3', true );
  //Gsap-ScrollTrigger
  wp_enqueue_script( 'Gsap-ScrollTrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/ScrollTrigger.min.js', array( ), '3.11.3', true );
  wp_enqueue_script( 'Gsap-ScrollTo', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/ScrollToPlugin.min.js', array( ), '3.11.3', true );
  
  

}
add_action( 'wp_enqueue_scripts', 'devhackathon_scripts' );

/* -------------------------------------------------------------------------------------*/
/* Thumbnails */
/* -------------------------------------------------------------------------------------*/
function devhackathon_thumbnail_support(){
    add_theme_support( 'post-thumbnails' );

    // ** Custom Thumbnails size **

    // Custom resizing not crop
    add_image_size( 'custom--small', 400, 400);
    add_image_size( 'custom--medium', 680, 680);
    add_image_size( 'custom--large', 1200, 1200);

    // Square with crop
    // add_image_size( 'square--small', 400, 400, true);
    // add_image_size( 'square--medium', 680, 680, true);
    // add_image_size( 'square--large', 1200, 1200, true);
}
add_action( 'after_setup_theme', 'devhackathon_thumbnail_support' );

// Option page ACF
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page();
}

// Google maps ACF
function my_acf_init() {
  acf_update_setting('google_api_key', 'KEYKEYKE');
}
add_action('acf/init', 'my_acf_init');


/* -------------------------------------------------------------------------------------*/
/* REmove "Archive :" prefix from title */
/* -------------------------------------------------------------------------------------*/
add_filter( 'get_the_archive_title_prefix', '__return_false' );

/* -------------------------------------------------------------------------------------*/
/* Extrait qui vient de the_content (limite le nombre des mots et replace [...] par ...) */
/* -------------------------------------------------------------------------------------*/
function excerpt( $limit = 15 ) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);

  if (count($excerpt) >= $limit) {
      array_pop($excerpt);
      $excerpt = implode(" ", $excerpt) . '...';
  } else {
      $excerpt = implode(" ", $excerpt);
  }

  $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

  return $excerpt;
}

/*
* Extrait (the_excerpt) de 20 mots et replace [...] par ... 
*/
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );



/* -------------------------------------------------------------------------------------*/
/*  Modifie recherche Wordpress 
/* -------------------------------------------------------------------------------------*/
function my_search_form( $form ) {
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
        <label>
          <span class="screen-reader-text">' . __( 'Taper puis appuyer sur Entrée', 'devhackathon' ) . '</span>
          <input type="search" class="search-form__field" placeholder="' . __( 'Ce que vous cherchez...', 'devhackathon' ) . '" value="' . get_search_query() . '" name="s" />
        </label>
      </form>';
    return $form;
}
add_filter( 'get_search_form', 'my_search_form' );


/* -------------------------------------------------------------------------------------*/
/*  Modifie recherche Wordpress 
/* -------------------------------------------------------------------------------------*/
function hackathon_limit_change_posts_archive($query){
    if ( $query->is_search ) {
      $query->set('posts_per_page', 20);
    }
    return $query;
}
add_filter('pre_get_posts', 'hackathon_limit_change_posts_archive');

/* -------------------------------------------------------------------------------------*/
/* Modifie footer Wordpress */
/* -------------------------------------------------------------------------------------*/
function remove_footer_admin () {
  //echo '<a href="" target="_blank">Team5</a> a choisi pour votre site le CMS Opensource <a href="https://www.wordpress-fr.net/" target="_blank">Wordpress</a>, merci pour votre confiance.';
}
add_filter('admin_footer_text', 'remove_footer_admin');

/* -------------------------------------------------------------------------------------*/
/*  Remove h1 from the WordPress editor. */
/* -------------------------------------------------------------------------------------*/
function modify_editor_buttons( $init ) {
    $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre;';
    return $init;
}
add_filter( 'tiny_mce_before_init', 'modify_editor_buttons' );

/* -------------------------------------------------------------------------------------*/
/*  Unregister tags for posts */
/* -------------------------------------------------------------------------------------*/
function wpdocs_unregister_tags_for_posts() {
  unregister_taxonomy_for_object_type( 'post_tag', 'post' );
 }
 add_action( 'init', 'wpdocs_unregister_tags_for_posts' );

/* -------------------------------------------------------------------------------------*/
/* Change le message d'erreur à la connexion de Wordpress */
/* -------------------------------------------------------------------------------------*/
function no_wordpress_errors(){
  return 'Données incorrectes !';
}
add_filter( 'login_errors', 'no_wordpress_errors' );

/* -------------------------------------------------------------------------------------*/
/* Editeur peut utiliser wpml, créer editeurs, modifier les menus mais pas le thème */
/* -------------------------------------------------------------------------------------*/
function access_wpml_editeur() {
    $role = get_role( 'editor' );
    
    $role->add_cap('wpml_manage_translation_management');
    $role->add_cap('wpml_manage_string_translation');
    $role->add_cap('wpml_manage_theme_and_plugin_localization');
    $role->add_cap('wpml_manage_languages');
    $role->add_cap('wpml_manage_translation_analytics');
    $role->add_cap('edit_users');
    $role->add_cap('edit_theme_options');
    $role->add_cap('list_users');
    $role->add_cap('promote_users');
    $role->add_cap('create_users');
    $role->add_cap('add_users');
    $role->add_cap('delete_users');    
}

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/* -------------------------------------------------------------------------------------*/
/* Enleve la possibilité d'éditer le code dans le back */
/* -------------------------------------------------------------------------------------*/
define( 'DISALLOW_FILE_EDIT', true );

/*Remove cdn Gravatar*/
function __default_local_avatar(){
  // this assumes default_avatar.png is in wp-content/themes/active-theme/images
  return get_bloginfo('template_directory') . '/images/default_avatar.png';
}
add_filter( 'pre_option_avatar_default', '__default_local_avatar' );

/* -------------------------------------------------------------------------------------*/
/* Retire les accents aux fichiers uploadés  */
/* -------------------------------------------------------------------------------------*/
add_filter('sanitize_file_name', 'remove_accents' );


/* -------------------------------------------------------------------------------------*/
/* Redirige les CPT signle presse vers l'accueil  */
/* -------------------------------------------------------------------------------------*/

function devhackathon_redirect_press_single() {
  if ( is_singular( 'presse' ) ) :
    wp_redirect( home_url(), 301 );
    exit;
  endif;
}
add_action( 'template_redirect', 'devhackathon_redirect_press_single' );



/* -------------------------------------------------------------------------------------*/
/* Allow SVG upload -- src: https://wpengine.com/resources/enable-svg-wordpress/  */
/* -------------------------------------------------------------------------------------*/
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
  global $wp_version;

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function hackathon_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'hackathon_mime_types' );
