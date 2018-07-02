<footer id="footer">

    <div class="wrapper">
        <?php wp_nav_menu( array( 'theme_location' => 'main-menu','container_id' => 'main-nav', 'container' => false, 'menu_id' => 'myMenu', 'menu_class' => 'main-menu menu' ) ); ?>
        <div class="partners">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/footer-logo-1.png" class="">

        </div>
        <p class="copyright"></p>

    </div>

</footer>
<div class="btn btn-primary" id="back-to-top"><i class="demo-icon icon-up-open-big"></i>
</div>
<?php wp_footer(); ?>
</div>
    </body>
        </html>
