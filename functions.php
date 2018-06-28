<?php

/* ==========================================================================
//Function to add Meta Tags in Header without Plugin 
========================================================================== */
function add_meta_tags() {
	echo '<meta name="meta_name" content="meta_value" />';
}
add_action( 'wp_head', 'add_meta_tags' );

add_theme_support( 'post-thumbnails' );
//
/**
 * Remove empty paragraphs created by wpautop()
 * @author Ryan Hamilton
 * @link https://gist.github.com/Fantikerz/5557617
 */

//function remove_empty_p( $content ) {
//	$content = force_balance_tags( $content );
//	$content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
//	$content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
//	return $content;
//}
//add_filter( 'the_content', 'remove_empty_p', 20, 1 );

function themename_post_formats_setup() {
    add_theme_support( 'post-formats', array( 'aside', 'gallery', 'video','chat','link','image', 'status', 'chat' ) );
}
add_action( 'after_setup_theme', 'themename_post_formats_setup' );


/* ==========================================================================
Standard – The default post format
Aside – A note like post, usually styled without title.
Gallery – A gallery of images.
Link – A link to another site.
Image – An image or photograph
Quote – A quotation.
Status – Twitter like short status update
Video – A post containing video
Audio – An audio file.
Chat – A chat transcript
========================================================================== */



function remove_head_scripts() {
	remove_action( 'wp_head', 'wp_print_scripts' );
	remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
	remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );

	add_action( 'wp_footer', 'wp_print_scripts', 5 );
	add_action( 'wp_footer', 'wp_enqueue_scripts', 5 );
	add_action( 'wp_footer', 'wp_print_head_scripts', 5 );
}
add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );


/* ==========================================================================
// Custom menu
========================================================================== */
register_nav_menus(
	array(
		'main-menu' => __( 'Main Menu' ),
		'mobile-menu' => __( 'Mobile Menu' ),
		'footer' => __( 'Footer' ),
		'top-menu' => __( 'Top Menu' )
	)
);
//login /logout
//emoji disable
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/* ==========================================================================
// Custom Scripting to Move JavaScript from the Head to the Footer
========================================================================== */
function my_jquery_remove() {
    if (!is_admin()) {

       wp_deregister_script('jquery');

       wp_register_script('jquery', false);

    }

}
add_action('init', 'my_jquery_remove'); 
/* ==========================================================================
// Custom Scripting to Move JavaScript from the Head to the Footer
========================================================================== */

function wptuts_scripts_load_cdn() {
	// Deregister the included library
	//wp_register_script( 'jquery' );

	// Register the library again from Google's CDN
	//wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', array(), null, false );

	// Register the script like this for a theme:
	/*    wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', array( 'jqueryjs' ) );
		wp_enqueue_script( 'jquery' );*/

	/*    wp_register_script( 'custom-script', get_template_directory_uri() . '/js/jquery.dotdotdot.min.js', array( 'jquery' ) );
	    wp_enqueue_script( 'custom-script' );*/
	wp_register_script( 'jq', get_template_directory_uri() . '/js/jquery.js', array( 'jquery' ) );
	wp_enqueue_script( 'jq' );
/*	wp_register_script( 'migration', get_template_directory_uri() . '/js/jquery-migrate-1.4.1.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'migration' );*/
	wp_register_script( 'font', get_template_directory_uri() . '/js/webfont.js', array( 'jquery' ) );
	wp_enqueue_script( 'font' );
	wp_register_script( 'utility', get_template_directory_uri() . '/js/modernizr-2.6.2.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'utility' );
/*	wp_register_script( 'truncate', get_template_directory_uri() . '/js/jQuery.succinct.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'truncate' );*/
	wp_register_script( 'nice', get_template_directory_uri() . '/js/jquery.mmenu.all.js', array( 'jquery' ) );
	wp_enqueue_script( 'nice' );
	wp_register_script( 'slide', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'slide' );
	wp_register_script( 'scroll', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ) );
	wp_enqueue_script( 'scroll' );
/*	wp_register_script( 'scrore', get_template_directory_uri() . '/js/jquery.parallax-scroll.js', array( 'jquery' ) );
	wp_enqueue_script( 'scrore' );*/
/*	wp_register_script( 'zopim', get_template_directory_uri() . '/js/zopim.js', array( 'jquery' ) );
	wp_enqueue_script( 'zopim' );*/
	wp_register_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ) );
	wp_enqueue_script( 'script' );
}
add_action( 'wp_enqueue_scripts', 'wptuts_scripts_load_cdn' );

/* ==========================================================================
// Load the theme stylesheets
========================================================================== */

function theme_styles() {

	wp_enqueue_style( 'main', get_template_directory_uri() . '/style.css',1 );
	wp_enqueue_style( 'fontello', get_template_directory_uri() . '/css/fontello.css' );
	wp_enqueue_style( 'fontello-codec', get_template_directory_uri() . '/css/fontello-codes.css' );
	wp_enqueue_style( 'fontello-embed', get_template_directory_uri() . '/css/fontello-embedded.css' );
	wp_enqueue_style( 'fontello-ie', get_template_directory_uri() . '/css/fontello-ie7.css' );
	wp_enqueue_style( 'animation', get_template_directory_uri() . '/css/animation.css' );
	wp_enqueue_style( 'mmenu', get_template_directory_uri() . '/css/jquery.mmenu.all.css' );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css' );
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/css/slick-theme.css' );
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/css/ui-theme.css' );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/q.css',2 );

	// Conditionally load the FlexSlider CSS on the homepage
//	if ( is_page( 'home' ) ) {
//		wp_enqueue_style( 'flexslider' );
//	}

}
add_action( 'wp_print_styles', 'theme_styles',99 );

/* ==========================================================================
// remove wp version param from any enqueued scripts
========================================================================== */

function vc_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
//
add_filter( 'the_title', 'blankslate_title' );

function blankslate_title( $title ) {
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}

/* ==========================================================================
widgets
========================================================================== */

function blankslate_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'blankslate' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s style="border:5px solid red;">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}


/* ==========================================================================
// function to count views
========================================================================== */


function setPostViews( $postID ) {
	$count_key = 'post_views_count';
	$count = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else {
		$count++;
		update_post_meta( $postID, $count_key, $count );
	}
}
function getCrunchifyPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
 
function setCrunchifyPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
 
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


/* ==========================================================================
//disable responsive images srcset
========================================================================== */

function meks_disable_srcset( $sources ) {
    return false;
}
 
add_filter( 'wp_calculate_image_srcset', 'meks_disable_srcset' );
/* ==========================================================================
//Excerpts to Your Pages in WordPress
========================================================================== */
add_post_type_support( 'page', 'excerpt' );

/* ==========================================================================
//Remove Query Strings
========================================================================== */
function _remove_script_version( $src ){
$parts = explode( '?ver', $src );
return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );



?>
