<?php
add_theme_support( 'post-thumbnails' );
/* ==========================================================================
//Excerpts to Your Pages in WordPress
========================================================================== */
add_post_type_support( 'page', 'excerpt' );
/* ==========================================================================
//Disable XML-RPC in WordPress
========================================================================== */
add_filter('xmlrpc_enabled', '__return_false');

require_once( get_template_directory() . '/func/add-meta-tag.php' );
require_once( get_template_directory() . '/func/post-format.php' );
require_once( get_template_directory() . '/func/register-nav-menu.php' );
require_once( get_template_directory() . '/func/display-featured-img-admin.php' );
require_once( get_template_directory() . '/func/js-css.php' );
require_once( get_template_directory() . '/func/remove-empty-p.php' );
require_once( get_template_directory() . '/func/widget.php' );
require_once( get_template_directory() . '/func/disable-img-src.php' );
//require_once( get_template_directory() . '/func/customizer.php' );
require_once( get_template_directory() . '/func/google-analytic-footer.php' );
require_once( get_template_directory() . '/func/sharpen-resized-JPEG.php' );
require_once( get_template_directory() . '/func/rss-post-thumbnail.php' );
require_once( get_template_directory() . '/func/style-first-paragraph.php' );
require_once( get_template_directory() . '/func/upload-file-format.php' );
require_once( get_template_directory() . '/func/custom-admin-login-logo.php' );

?>
