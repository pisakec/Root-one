<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<title><?php wp_title(''); ?></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="description" content="<?php bloginfo('description'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
    <link rel="alternate" href="https://sbobet.gclub-casino.com/" hreflang="th"/>
    <meta name="viewport" content="width=device-width"/>
    <?php wp_head(); ?>
    <style>
        #my-menu:not( .mm-menu) {
            display: none;
        }
    </style>
    <?php
	function mytheme_customize_css()
{
    ?>
         <style type="text/css">
             h1 { color: <?php echo get_theme_mod('text_color', '#000000'); ?>; }
         </style>
    <?php
}
add_action( 'wp_head', 'mytheme_customize_css');
	?>
</head>


<body <?php body_class(); ?>>
    <div id="my-page" style="border: 5px solid #000;">
        <header id="header" style="" class="desktop">
            <div class="wrapper">
                <div id="site-title">
                    <a href="<?php echo get_home_url(); ?>" class="logo-header"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg" class="logo-main"></a>
                    <div id="site-description">
                        <?php bloginfo( 'description' ); ?>
                    </div>
                    <?php wp_nav_menu( array( 'theme_location' => 'main-menu','container_id' => 'main-nav', 'container' => false, 'menu_id' => 'myMenu', 'menu_class' => 'menu-mobile menu' ) ); ?>
                </div>
            </div>
        </header>

        <header class="mobile" id="mobile">
       
<a href="#mobile-nav" id="my-icon" class="hamburger hamburger--collapse">
   <span class="hamburger-box">
      <span class="hamburger-inner"></span>
   </span>
</a>

            </a>
            <a href="<?php echo get_home_url(); ?>" class="logo-header"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg" class="logo-main"></a>
            <a href="#contact-menu"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon-line.png" class="icon-line"></a>
        </header>
        <div id="mobile-nav" style="border:5px solid red;">
            <a href="<?php echo get_home_url(); ?>" class="logo-header"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg" class="logo-main"></a>
            <?php wp_nav_menu( array( 'theme_location' => 'main-menu','container_id' => 'main-nav', 'container' => false, 'menu_id' => 'myMenu', 'menu_class' => 'menu-mobile' ) ); ?>
        </div>

<?php /*?>        <div id="contact-menu">
            <div class="header-contact">
                <a href="https://line.me/R/ti/p/%40sportasia" class="header-btn line-casino" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icon-line-contact.png" alt="line" class="mm-line-icon"><span style="color:#00c300;">@sportasia</span></a>
                <span class="hotline contact-link"><strong>ติดต่อสอบถาม 24 ชม.</strong> <a href="tel:02-026-9397">02-026-9397</a>
                    <a href="tel:02-026-9398">02-026-9398</a></span>
                <a href="http://m.e16811.com/web-root/public/login.aspx" class="btn header-btn register" target="_blank">เดิมพันบนมือถือ</a>
            </div>
        </div><?php */?>
