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
function themename_post_formats_setup() {
    add_theme_support( 'post-formats', array( 'aside', 'gallery', 'video','chat','link','image', 'status', 'chat' ) );
}
add_action( 'after_setup_theme', 'themename_post_formats_setup' );


/* ==========================================================================
Theme Customization API
========================================================================== */
function mytheme_customize_register( $wp_customize ) {
   //All our sections, settings, and controls will be added here
}
add_action( 'customize_register', 'mytheme_customize_register' );


function mytheme_customizer_live_preview()
{
	wp_enqueue_script( 
		  'mytheme-themecustomizer',			//Give the script an ID
		  get_template_directory_uri().'/assets/js/theme-customizer.js',//Point to file
		  array( 'jquery','customize-preview' ),	//Define dependencies
		  '',						//Define a version (optional) 
		  true						//Put script in footer?
	);
}
add_action( 'customize_preview_init', 'mytheme_customizer_live_preview' );


/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since MyTheme 1.0
 */
class MyTheme_Customize {
   /**
    * This hooks into 'customize_register' (available as of WP 3.4) and allows
    * you to add new sections and controls to the Theme Customize  screen.
    * 
    * Note: To enable instant preview, we have to actually write a bit of custom
    * javascript. See live_preview() for more.
    *  
    * @see add_action('customize_register',$func)
    * @param \WP_Customize_Manager $wp_customize
    * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
    * @since MyTheme 1.0
    */
   public static function register ( $wp_customize ) {
      //1. Define a new section (if desired) to the Theme Customizer
      $wp_customize->add_section( 'mytheme_options', 
         array(
            'title'       => __( 'MyTheme Options', 'mytheme' ), //Visible title of section
            'priority'    => 35, //Determines what order this appears in
            'capability'  => 'edit_theme_options', //Capability needed to tweak
            'description' => __('Allows you to customize some example settings for MyTheme.', 'mytheme'), //Descriptive tooltip
         ) 
      );
      
      //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'link_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => '#2BA6CB', //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'mytheme_link_textcolor', //Set a unique ID for the control
         array(
            'label'      => __( 'Link Color', 'mytheme' ), //Admin-visible name of the control
            'settings'   => 'link_textcolor', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 10, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );
      
      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
      $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
      $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
   }

   /**
    * This will output the custom WordPress settings to the live theme's WP head.
    * 
    * Used by hook: 'wp_head'
    * 
    * @see add_action('wp_head',$func)
    * @since MyTheme 1.0
    */
   public static function header_output() {
      ?>
      <!--Customizer CSS--> 
      <style type="text/css">
           <?php self::generate_css('#site-title a', 'color', 'header_textcolor', '#'); ?> 
           <?php self::generate_css('body', 'background-color', 'background_color', '#'); ?> 
           <?php self::generate_css('a', 'color', 'link_textcolor'); ?>
      </style> 
      <!--/Customizer CSS-->
      <?php
   }
   
   /**
    * This outputs the javascript needed to automate the live settings preview.
    * Also keep in mind that this function isn't necessary unless your settings 
    * are using 'transport'=>'postMessage' instead of the default 'transport'
    * => 'refresh'
    * 
    * Used by hook: 'customize_preview_init'
    * 
    * @see add_action('customize_preview_init',$func)
    * @since MyTheme 1.0
    */
   public static function live_preview() {
      wp_enqueue_script( 
           'mytheme-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/assets/js/theme-customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional) 
           true // Specify whether to put in footer (leave this true)
      );
   }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'MyTheme_Customize' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'MyTheme_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'MyTheme_Customize' , 'live_preview' ) );




/* ==========================================================================
Remove head script
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
