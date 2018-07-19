<?php
/* ==========================================================================
//Function to add Meta Tags in Header without Plugin 
========================================================================== */
function add_meta_tags() {
	echo '<meta name="meta_name" content="meta_value" />';
}
add_action( 'wp_head', 'add_meta_tags' );
?>